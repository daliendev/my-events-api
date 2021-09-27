<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->where('email', '<>', '', 'and')->paginate()->toArray();
        return $this->sendResponse(['users' => $users], 'Les utilisateurs ont été récupérés avec succès.');
    }
     /**
     * Display the specified user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user)
            return $this->sendError('Utilisateur introuvable.', null, 404);
        $hangouts = $user->hangouts;
        return $this->sendResponse($user->toArray(), 'Utilisateur récupéré avec succès.');
    }
     /**
     * Display exclusively currently auth user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCurrent()
    {
        $user = auth()->user();
        if (!$user)
            return $this->sendError('Utilisateur introuvable.', null, 404);
        $hangouts = $user->hangouts;
        return $this->sendResponse($user->toArray(), 'Utilisateur récupéré avec succès.');
    }
    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user)
            return $this->sendError('Bearer TOKEN expiré.', 401);
        if (intval($user->id) === intval($id)){
            if ($user->fill($request->all())->save())
                return $this->sendResponse($user, 'Compte mis à jour avec succès.');
        }else{
            if($user->admin){
                $userToUpdate = User::where('id', $id)->first();
                if ($userToUpdate->fill($request->all())->save())
                    return $this->sendResponse($userToUpdate, 'Compte mis à jour avec succès.');
            }else
                return $this->sendError('Sans être ADMIN, vous pouvez apporter des modifications uniquement à votre compte.', null, 401);
        }
        return $this->sendError('Le compte n\'a pas pu être mis à jour (vérifiez les champs et réessayez).', null, 500);
    }
    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if (!$user)
            return $this->sendError('Bearer TOKEN expiré.', 401);
        if (intval($user->id) === intval($id)){
            if ($user->delete())
                return $this->sendResponse(null, 'Compte supprimé avec succès.');
        }else{
            if($user->admin){
                $userToUpdate = User::where('id', $id)->first();
                if ($userToUpdate->delete())
                    return $this->sendResponse(null, 'Compte supprimé avec succès.');
            }else
                return $this->sendError('Sans être ADMIN, vous pouvez supprimer uniquement votre compte.', null, 401);
        }
        return $this->sendError('Le compte n\'a pas pu être supprimé (vérifiez les champs et réessayez).', null, 500);
    }
     /**
     * Display a listing of hangouts (wich are linked to the auth user).
     *
     * @return \Illuminate\Http\Response
     */
    public function showHangouts(Request $request, $id)
    {
        $user = User::find($id);
        $hangouts_public = $user->hangouts->where('public', '1');
        $hangouts_private = $user->hangouts->where('public', '0');
        foreach ($hangouts_private as $hangout) {
            $participant = false;
            foreach ($hangout->users as $user) {
                if($user->id === auth()->user()->id)
                    $participant = true;
            }
            if(!$participant)
                $hangouts_private->shift();
        }
        $data = [
            "public" => $hangouts_public->values(),
            "private" => $hangouts_private->values()
        ];
        if($hangouts_public && $data)
            return $this->sendResponse(['hangouts' => $data], 'Les sorties de cet utilisateur ont été récupérées avec succès.');
        else
            return $this->sendError('Les sorties de cet utilisateur n\'ont pas pu être récupérées.', null, 500);
    }
}