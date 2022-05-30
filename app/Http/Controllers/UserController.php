<?php

namespace App\Http\Controllers;

use App\Mail\CredentialsGeneratedUser;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request) {
//        dd($request->getRequestUri());
        if ($request->getRequestUri() === '/create/user/admin?') {
            return view('admin.createUser')->with('role', 'Admin');
        }else {
            return view('admin.createUser')->with('role', 'Client');
        }
    }


    public function store(Request $request) {
//        dd($request);
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->userName;
        $user->address = $request->address;
        $user->email = $request->email;
        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);

        $user->save();

        if($request->role === "Admin"){
            $user->assignRole(["Admin", "Generated Password"]);
        }elseif ($request->role === "Client"){
            $user->assignRole(["Client", "Generated Password"]);
        }

        Mail::to($request->email)->send(new CredentialsGeneratedUser($user, $password));

        return redirect()->route('home')->with('success','Usuario creado correctamente');
    }

    public function showUser(Request $request) {
//        dd($request->id);
        $user = User::find($request->id);
//        dd($user);
        return view('admin.showUser')->with('user', $user);
    }

    public function showUpdate(Request $request) {
//        dd($request->id);
        $user = User::find($request->id);
        return view('admin.editUser')->with('user', $user);
    }

    public function update(Request $request) {
//        dd($request);
        $user = User::find($request->id);

        $user-> name = $request->name;
        $user->username = $request->userName;
        $user->address = $request->address;
        $user->email = $request->email;

        $user->save();

        return redirect('home')->with('success', 'success');
    }

    public function softDeleteUser(Request $request) {
        $user = User::find($request->id);

        $user->delete();

        if($user->deleted_at == 'NULL') {
            return (false);
        }else {
            return redirect('home')->with('success','success');
        }
    }

    public function resetPassword(Request $request)
    {
//        dd($request);
        if ($request->password !== $request->password_confirmation) {
            return view('password.resetPassword')->with('error', 'Passwords do not match')->with('user', $request)->with('token', $request->token);
        }else {
            $user = User::find(auth()->id());

            $user->password = Hash::make($request->password);
            $user->updated_at = now();

            $user->save();

            if ($user->roles()->first()->name === 'Client') {
                return view('home')/*->with()*/;
            }else {
                return view('home')->with('users', (new HomeController)->getUsers());
            }
        }
    }

    public function changeVerifyEmail() {
        $user = User::find(auth()->id());

//        dd($user);

        $user->email_verified_at = now();

        $user->save();

        if ($user->roles()->first()->name === 'Client') {
            return view('home')/*->with()*/;
        }else {
            return view('home')->with('users', (new HomeController)->getUsers());
        }
    }

    public function resendVerifyEmail() {
        $user = User::find(auth()->id());

        Mail::to($user->email)->send(new VerifyEmail($user->email));

        return view('client.verifyEmail');
    }
}
