<?php

use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.welcome');
})->name('welcome');

Auth::routes(['verify' => 'true']);

//Show view home
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

//When an user login, redirect to CheckUserController to check if the user is created by an admin, a real client or an
//admin. If the user is created by and admin, it will be redirected to a view to change the password obligatory.
Route::get('/check', [CheckUserController::class, 'check'])->middleware(['auth', 'verified'])->name('checkUser');

//When an admin want to create an user, return a view with the rol of the user.
Route::get('/create/user/{role}', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('show.create.user');

//When admin want to create a user
Route::post('/create/user', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('create.user');

//When an admin want to show an user, return a view with the user.
Route::get('/show/user/{id}', [UserController::class, 'showUser'])->middleware(['auth', 'verified'])->name('show.user');

//When Super Admin want to edit a user
Route::get('/edit/user/{id}', [UserController::class, 'showUpdate'])->middleware(['auth', 'verified'])->name('show.update.user');

//When Super Admin update an user
Route::post('/update/user', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('update.user');

//When Admin soft-delete an user
Route::post('/softdelete/user', [UserController::class, 'softDeleteUser'])->middleware(['auth', 'verified'])->name('softdelete.user');

//Route to reset the password if an user was created by an admin
Route::post('/password/reset/new', [UserController::class, 'resetPassword'])->middleware(['auth', 'verified'])->name('password.reset.new');

//When a user use the link to verify the email, they call the controller to change the email_verified_at
Route::get('/verify/email', [UserController::class, 'changeVerifyEmail'])->middleware(['auth', 'verified'])->name('change.verify.email');

//When an user click the link to resend the email
Route::get('/resend/verify/email', [UserController::class, 'resendVerifyEmail'])->middleware(['auth', 'verified'])->name('resend.verify.email');

