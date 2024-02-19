<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use validater;
use App\Http\Requests\Auth\LoginRequest;

class AccountApiController extends Controller
{

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {

            $user = User::where('email',$request->email)->first();

           $tokens['token'] = $user->createToken('Token Name')->accessToken;

           return $tokens;

        }
        else{

            return 'login field';

        }
    }
    public function index(Request $request)
    {
         $authUser = $request->user();

         $userAccounts = UserAccount::orderBy('id','desc')->get();

         $userAccount['statement'] =  $userAccounts;

         return $userAccount;

    }
}
