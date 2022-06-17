<?php

use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
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
    return redirect('home');
})->name('welcome');

Auth::routes(['verify' => 'true']);

//Show view home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//When an user login, redirect to CheckUserController to check if the user is created by an admin, a real client or an
//admin. If the user is created by and admin, it will be redirected to a view to change the password obligatory.
Route::get('/check', [CheckUserController::class, 'check'])->middleware(['auth', 'verified'])->name('checkUser');

//User list for Admin and Super Admin
Route::get('/user/list', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('user.list');

//Product list for Admin and Super Admin
Route::get('/product/list', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('product.list');

//When an admin want to create an user, return a view with the rol of the user.
Route::get('/create/user/{role}', [UserController::class, 'showCreateUser'])->middleware(['auth', 'verified'])->name('show.create.user');

//When an admin want to create a product.
Route::get('/create/product', [ProductController::class, 'showCreateProduct'])->middleware(['auth', 'verified'])->name('show.create.product');

//When admin want to create a user
Route::post('/create/user', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('create.user');

//When admin want to create a product
Route::post('/create/product', [ProductController::class, 'store'])->middleware(['auth', 'verified'])->name('create.product');

//When an admin want to show an user, return a view with the user.
Route::get('/show/user/{id}', [UserController::class, 'showUser'])->middleware(['auth', 'verified'])->name('show.user');

//When Super Admin want to edit a user
Route::get('/edit/user/{id}', [UserController::class, 'showUpdate'])->middleware(['auth', 'verified'])->name('show.update.user');

//When Super Admin update an user
Route::post('/update/user', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('update.user');

//When Admin soft-delete an user
Route::delete('/softdelete/user', [UserController::class, 'softDeleteUser'])->middleware(['auth', 'verified'])->name('softdelete.user');

//When Admin delete an user
Route::delete('/delete/user', [UserController::class, 'deleteUser'])->middleware(['auth', 'verified'])->name('delete.user');

//When admin want to restore a user
Route::post('/restore/user', [UserController::class, 'restoreUser'])->middleware(['auth', 'verified'])->name('restore.user');

//When admin want to show a product
Route::get('/show/product/{id}', [ProductController::class, 'showProduct'])->middleware(['auth', 'verified'])->name('show.product');

//When admin want to show a product
Route::get('/show/update/product/{id}', [ProductController::class, 'showUpdateProduct'])->middleware(['auth', 'verified'])->name('show.update.product');

//When Super Admin update a product
Route::post('/update/product', [ProductController::class, 'update'])->middleware(['auth', 'verified'])->name('update.product');

//When Admin delete an user
Route::delete('/delete/product', [ProductController::class, 'deleteProduct'])->middleware(['auth', 'verified'])->name('delete.product');

//When a client do a search by filters
Route::post('/home', [ProductController::class, 'searchProductByFilter'])->middleware(['auth', 'verified'])->name('search.product');

//When an user want to change his perfil
Route::get('/mydata', [UserController::class, 'showMyData'])->middleware(['auth', 'verified'])->name('show.mydata');

//When an user update his perfil
Route::post('/mydata/update', [UserController::class, 'updateUser'])->middleware(['auth', 'verified'])->name('user.update');

//Checkout cart
Route::post('/checkout', [OrderController::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout.cart');

//Generate user pdf
Route::get('/generate/users/pdf', [PdfController::class, 'generateUsersPdf'])->middleware(['auth', 'verified'])->name('generate.users.pdf');

//Generate products pdf
Route::get('/generate/products/pdf', [PdfController::class, 'generateProductsPdf'])->middleware(['auth', 'verified'])->name('generate.products.pdf');
/**/


//Route to reset the password if an user was created by an admin
Route::post('/password/reset/new', [UserController::class, 'resetPassword'])->middleware(['auth', 'verified'])->name('password.reset.new');

//When a user use the link to verify the email, they call the controller to change the email_verified_at
Route::get('/verify/email', [UserController::class, 'changeVerifyEmail'])->middleware(['auth', 'verified'])->name('change.verify.email');

//When an user click the link to resend the email
Route::get('/resend/verify/email', [UserController::class, 'resendVerifyEmail'])->middleware(['auth', 'verified'])->name('resend.verify.email');


Route::get('migrate', function() {
    \Artisan::call('migrate:fresh --seed');
    $output = Artisan::output();
    dd($output);
});

Route::get('cache-clear', function() {
    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');
    \Artisan::call('view:cache');
    $output = Artisan::output();
    dd($output);
});
