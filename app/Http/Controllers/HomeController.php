<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        dd(Auth::user()->roles()->first()->name);
        if(Auth::user()->roles()->first()->name === 'Super Admin') {
            $users = $this->getUsers();
//          dd($users);
            return view('home')->with('users', $users);
        }else if(Auth::user()->roles()->first()->name === 'Admin') {
            $users = $this->getUsers();
            return view('home')->with('users', $users);
        }else {
//                $products = getProducts();
                return view('home')/*->with()*/;
        }
    }

    /**
     * Return all the users except the actual user that login.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getUsers() {

        return User::withTrashed()->whereNotIn('id', [Auth::user()->id])->get();
    }

//    public function getProducts() {
//
//    }
}
