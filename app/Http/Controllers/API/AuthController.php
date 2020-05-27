<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ProcessResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class AuthController extends Controller
{
    use ProcessResponseTrait;
    public function login(Request $request)
    {
         
      $request->validate([
       'user_id'=>'required',
       'password'=>'required',

      ]);
         
         try {
          $http = new \GuzzleHttp\Client;

          $response = $http->post('http://localhost:8000/oauth/token', [
              'form_params' => [
                  'grant_type' => Config::get('settings.passport.grant_type'),
                  'client_id' => Config::get('settings.passport.client_id'),
                  'client_secret' => Config::get('settings.passport.client_secret'),
                  'scope' => Config::get('settings.passport.scope'),
                  'username' => $request->email,
                  'password' => $request->password,
              ],
          ]);
        
          return json_decode((string) $response->getBody(), true);
      }
      catch (\GuzzleHttp\Exception\BadResponseException $e)
      {
          return $this->processResponse($e->getCode(),'error','Something went wrong');

    }
}

      public function logout()
    {
     $this->revokeToken(Auth::user()->tokens);

     return $this->processResponse(null,'success','Logged out successfully!');
    }
  
     public function register()
     {
          return 'register';
     }

     public function revokeToken($tokens)
     {
         foreach($tokens as $token)
         {
             $token->revoke();
         }
     }
}
