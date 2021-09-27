<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'picture' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'confirm_password' => 'required|same:password',
        ]);
        $filePath = NULL;
        if($request->picture){
            $fileName = time().'_'.$request->picture->getClientOriginalName();
            $filePath = "/storage/" . $request->file('picture')->storeAs('uploads/users', $fileName, 'public');
        }
        if($request->bio) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'password' => bcrypt($request->password),
                'picture' => $filePath,
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'picture' => $filePath,
            ]);
        }
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $user->sendEmailVerificationNotification();
        return $this->sendResponse(['token' => $token], 'Inscription réussie. Email de vérification envoyé !');
    }
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = false;
        if($request->remember !== NULL)
            $remember = (intval($request->remember) === 1) ? true : false;
        if ($request->password !== NULL && auth()->attempt($data, $remember)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return $this->sendResponse(['token' => $token], 'Connexion réussie.');
        } else {
            return $this->sendError('La connexion a échoué.', ['error' => 'Unauthorised'], 401);
        }
    } 
    /**
     * Logout
     */
    public function logout (Request $request) {
        $user = $request->user();
        if($user->token()->revoke()){
            $user->remember_token = NULL;
            $user->save();
            return $this->sendResponse(['token' => NULL], 'Deconnexion réussie !');
        }
        return $this->sendError('La déconnexion a échoué.', null, 404);
    }
    /**
     * Google Sign In
     * Create a new account for new user
     * Just give access token if user already exists
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function googleSignIn(Request $request)
    {
        $this->validate($request, [
            'id_token' => 'required'
        ]);
        $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
            'id_token' => $request->id_token
        ]);
        if($response->ok()){
            $account = $response->object();
            $user = User::where('email', $account->email)->first();
            if($user){
                $token = $user->createToken('LaravelAuthApp')->accessToken;
                if($token)
                    return $this->sendResponse(['token' => $token], 'Connexion réussie.');
                return $this->sendError('La connexion a échoué.', ['error' => 'Unauthorised'], 401);
            }else{
                $user = User::create([
                    'name' => $account->name,
                    'picture' => $account->picture,
                    'email' => $account->email,
                    'password' => NULL
                ]);
                $token = $user->createToken('LaravelAuthApp')->accessToken;
                return $this->sendResponse(['token' => $token], 'Inscription réussie.');
            }
            return $this->sendError('Connexion/Inscription impossible. Bien que Token ID valide.', null, 401);
        }else{
            // Invalid ID token
            return $this->sendError('TOKEN_ID invalide, connexion / inscription impossible.', null, 401);
        }
    }  
    /**
    *   VERIFY EMAIL
    **/
    function verifyEmail (Request $request, $id, $hash) {
        // $request->fulfill();
        $user = User::where('id', $id)->first();
        if($user && $user->email_verified_at === NULL){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
            return $this->sendResponse(null, 'Verification de l\'email réussie.');
        }
        return $this->sendError('Compte introuvable ou email déjà vérifié.', null, 403);
    }
    /**
    *   RESEND VERIFY EMAIL
    **/
    function resendEmail (Request $request, $id) {
        $user = User::where('id', $id)->first();
        if($user && $user->email_verified_at === NULL){
            $user->sendEmailVerificationNotification();
            return $this->sendResponse(null, 'Email de verification envoyé !');
        }
        return $this->sendError('Compte introuvable ou email déjà vérifié.', null, 403);
    }
    /**
    *   PASSWORD RESET
    **/
    function forgotPassword (Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return ($status === Password::RESET_LINK_SENT)
                    ? $this->sendResponse(null, 'Email de mise à jour du mot de passe envoyé.')
                    : $this->sendError('Envoi de l\'email de mise à jour du mot de passe impossible.', null, 403);
    }
    function resetPassword (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);
                $user->save();
            }
        );
        return ($status === Password::PASSWORD_RESET)
                    ? $this->sendResponse(null, 'Mise à jour du mot de passe effectuée.')
                    : $this->sendError('Impossible d\'effectuer cette opération.', null, 401);
    }
}
