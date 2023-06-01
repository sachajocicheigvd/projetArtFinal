<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Genre;
use App\Models\User;
use App\Http\Controllers\GenreUserController;
use App\Http\Controllers\AnswerUserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('chat', function () {
    return view('chat');
});
Route::get('sondage', function () {
    return view('sondage');
});

Route::resource("mon-compte", UserController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('registerbis', function () {
    return view('registerbis')->with('genres', Genre::all())->with('user', Auth::user());
})->name('registerbis');

Route::post('registerbis', [GenreUserController::class, 'saveGenre']);

Route::get('creationsondage', function () {
    return view('creationsondage')->with('user', Auth::user());
})->name('creationsondage');

Route::post('creationsondage', [AnswerUserController::class, 'saveAnswer'])->name('creationsondage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
