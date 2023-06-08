<?php

use App\Events\Message;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatsController;

use App\Models\Genre;
//use App\Models\User;
use App\Http\Controllers\GenreUserController;
use App\Http\Controllers\AnswerUserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\sondageController;
use App\Http\Controllers\sondageSachaController;
use App\Http\Controllers\VoteController;
use App\Models\Survey;
use App\Models\Answer;
use App\Models\AnswerUser;
use App\Models\GenreUser;



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

// Route principale
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

// Chat
Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'afficheMessage']);
Route::post('/send-message', [App\Http\Controllers\ChatsController::class, 'enregistrement']);

// Toute la partie sondage

Route::middleware('admin')->group(function () {
    Route::get('creationsondage', [SurveyController::class, 'showForm'])->name('creationsondage');
    Route::post('creationsondage', [SurveyController::class, 'saveSurvey']);
});

Route::get('/sondage', [App\Http\Controllers\sondageController::class, 'afficheSondage']);
Route::get('/sondagesacha', [App\Http\Controllers\sondageSachaController::class, 'afficheSondage']);

Route::get("vote", [AnswerUserController::class, 'showForm'])->name('vote');
Route::post("vote", [AnswerUserController::class, 'saveAnswer']);

Route::get('lastsondage', [SurveyController::class, 'lastSurvey'])->name('lastsondage');
Route::post('storevote',  [AnswerUserController::class, 'storevote'])->name('storevote');

Route::get('/refreshhondage', [App\Http\Controllers\sondageController::class, 'refreshSondage']);


/*
* GESTION DU COMPTE
*/

// Accès à la page de gestion du compte
Route::resource("mon-compte", UserController::class);

// Genre
Route::get('registerbis', [GenreUserController::class, 'showForm'])->name('registerbis');
Route::post('registerbis', [GenreUserController::class, 'saveGenre']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
