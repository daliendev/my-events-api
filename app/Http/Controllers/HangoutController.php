<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Hangout;
use App\Models\User;

class HangoutController extends Controller
{
    /**
     * Display a listing of hangouts (wich are public).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hangouts = Hangout::orderBy('id', 'desc')->where('public', '=', '1')->paginate();
        foreach ($hangouts as $key => $hangout) {
            // GET THE CREATOR DATA
            $creator = User::find($hangout->creator_id);
            // IS ALREADY PARTICIPANT OR NOT
            $users = $hangout->users;
            $already_participant = false;
            foreach ($users->toArray() as $user) {
                if($user['id'] === auth()->user()->id)
                    $already_participant = true;
            }
            // GET THE EVENT DATA
            $response = Http::get('https://api.openagenda.com/v2/agendas/' . $hangout->extern_agenda_id . '/events/' . $hangout->extern_event_id . '?key=7dd1a71611df4549a4afd0b7e8a09f95');
            if($response->ok()){
                $event = $response->object();
                $hangouts[$key] = ["hangout" => $hangout, "alreadyParticipant" => $already_participant, "creator" => $creator, "event" => $event];
            }else
                $hangouts[$key] = ["hangout" => $hangout, "alreadyParticipant" => $already_participant, "creator" => $creator, "event" => null];
        }
        return $this->sendResponse(['public' => $hangouts], 'Les sorties publiques ont été récupérées avec succès.');
    }
     /**
     * Display the specified resource (wich is public or linked to the auth user).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hangout = Hangout::find($id);
        if(!$hangout->public){
            $hangout = auth()->user()->hangouts()->find($id);
        }
        if (!$hangout)
            return $this->sendError('Sortie introuvable ou privée.', null, 404);
        return $this->sendResponse($hangout->toArray(), 'Sortie récupérée avec succès.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'extern_agenda_id' => 'required',
            'extern_event_id' => 'required',
            'public' => 'required'
        ]);
        $hangout = new Hangout();
        $hangout->creator_id = auth()->user()->id;
        $hangout->extern_agenda_id = $request->input('extern_agenda_id');
        $hangout->extern_event_id = $request->input('extern_event_id');
        $hangout->public = $request->input('public');
        if (auth()->user()->hangouts()->save($hangout))
            return $this->sendResponse($hangout->toArray(), 'Sortie créée avec succès.');
        else
            return $this->sendError('La sortie n\'a pas pu être créé (vérifiez les champs et réessayez).', null, 500);
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hangout = Hangout::where('id', $id)->where('creator_id', auth()->user()->id)->first();
        if (!$hangout)
            return $this->sendError('Sortie introuvable ou vous n\'avez pas les droits.', 404);
        if ($hangout->fill($request->all())->save())
            return $this->sendResponse($hangout, 'Sortie mise à jour avec succès.');
        else
            return $this->sendError('La sortie n\'a pas pu être mise à jour (vérifiez les champs et réessayez).', null, 500);
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hangout = Hangout::where('id', $id)->where('creator_id', auth()->user()->id)->first();
        if (!$hangout)
            return $this->sendError('Sortie introuvable ou vous n\'avez pas les droits.', 404);
        if ($hangout->delete())
            return $this->sendResponse(null, 'Sortie supprimée avec succès.');
        else
            return $this->sendError('La sortie n\'a pas pu être supprimé (vérifiez les champs et réessayez).', null, 500);
    }
     /**
     * Get specified resource from Open Agenda API.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestEvents(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|regex:`https://api.openagenda.com/v2/[a-zA-z0-9!$%&()_+={}\[\]:";<>?,.\/]+`',
        ]);
        $response = Http::get($request->url);
        if($response->ok()){
            $events = $response->object();
            return $this->sendResponse($events, 'Evenements récupérés avec succès.');
        }
        else
            return $this->sendError('Impossible de récupérer les évenements, veuillez contacter l\'administrateur.', 404);
    }
     /**
     * Display a listing of users (wich are linked to the hangout).
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers(Request $request, $id)
    {
        $hangout = Hangout::where('id', $id)->first();
        $users = $hangout->users;
        $rights = ($hangout->public || auth()->user()->admin) ? true : false;
        if(!$rights){
            foreach ($users->toArray() as $user) {
                if($user['id'] === auth()->user()->id)
                    $rights = true;
            }
        }
        if($users && $rights)
            return $this->sendResponse(['users' => $users], 'Les participants à cette sortie ont été récupérées avec succès.');
        else
            return $this->sendError('Les participants à cette sortie n\'ont pas pu être récupérées (sortie inexistante ou privée).', null, 500);
    }
     /**
     * A route for current user to join a hangout.
     *
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, $id)
    {
        $hangout = Hangout::where('id', $id)->first();
        if($hangout === NULL)
            return $this->sendError('Sortie inexistante.', null, 404);
        if($hangout->public){
            $users = $hangout->users;
            $already_participant = false;
            foreach ($users->toArray() as $user) {
                if($user['id'] === auth()->user()->id)
                    $already_participant = true;
            }
            if(!$already_participant){
                $hangout->users()->attach(auth()->user()->id);
                return $this->sendResponse(['hangout' => $hangout], 'Vous avez rejoint cette sortie avec succès.');
            }
            else
                return $this->sendError('Vous avez déjà rejoins cette sortie.', null, 401);
        }else
            return $this->sendError('Sortie privée, veuillez contacter son organisateur.', null, 401);
    }
     /**
     * A route to invite someone into a hangout.
     *
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request, $id, $user_id)
    {
        $hangout = Hangout::where('id', $id)->first();
        if($hangout === NULL)
            return $this->sendError('Sortie inexistante.', null, 404);
        if($hangout->public){
            $users = $hangout->users;
            $already_participant = false;
            foreach ($users->toArray() as $user) {
                if($user['id'] === auth()->user()->id)
                    $already_participant = true;
            }
            if($already_participant){
                $hangout->users()->attach($user_id);
                return $this->sendResponse(['hangout' => $hangout], 'Participant invité à cette sortie avec succès.');
            }
            else
                return $this->sendError('Vous devez être un participant pour pouvoir inviter quelqu\'un dans une sortie publique.', null, 401);
        }else{
            if($hangout->creator_id === auth()->user()->id){
                $hangout->users()->attach($user_id);
                return $this->sendResponse(['hangout' => $hangout], 'Participant invité à cette sortie avec succès.');
            }
            return $this->sendError('Seul l\'organisateur peut ajouter des participants à une sortie privée.', null, 401);
        }
    }
     /**
     * A route for current user to leave a hangout
     *
     * @return \Illuminate\Http\Response
     */
    public function leave(Request $request, $id)
    {
        $hangout = Hangout::where('id', $id)->first();
        if($hangout === NULL)
            return $this->sendError('Sortie inexistante.', null, 404);
        $users = $hangout->users;
        $already_participant = false;
        foreach ($users->toArray() as $user) {
            if($user['id'] === auth()->user()->id)
                $already_participant = true;
        }
        if($already_participant){
            $hangout->users()->detach(auth()->user()->id);
            if($hangout->creator_id === auth()->user()->id){
                $hangout->delete();
                return $this->sendResponse(null, 'Vous avez quitté cette sortie avec succès, comme vous êtiez son créateur elle est maintenant supprimée.');
            }
            return $this->sendResponse(null, 'Vous avez quitté cette sortie avec succès.');
        }
        else
            return $this->sendError('Vous ne faîte déjà pas partie de cette sortie.', null, 401);
    }
}
