<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


/*
    C:\xampp\htdocs\OAuth2_Laravel>php artisan passport:install
        Encryption keys generated successfully.
        Personal access client created successfully.
        Client ID: 1
        Client secret: 10kOnmqgu8GdRAHqzcVio5VY5abQuBKDKaJMJhta
        Password grant client created successfully.
        Client ID: 2
        Client secret: Iuq7JCaO7BpoPltWzBnR3nqkreqMfkJr8KNkbO6Q

 */
