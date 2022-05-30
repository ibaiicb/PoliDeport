<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckUserController extends Controller
{
    public function check()
    {
        $user = User::find(auth()->id());
//        dd($user->email_verified_at);

        if($user->email_verified_at === null) {
            Mail::to($user->email)->send(new VerifyEmail($user->email));

            return view('client.verifyEmail');
        }else{
            if(@Auth::user()->hasRole('Generated Password')) {
                return view('password.resetPassword')->with('user', $user)->with('token', $user->remember_token);
            }else{
                return redirect('home');
            }
        }
    }
}
