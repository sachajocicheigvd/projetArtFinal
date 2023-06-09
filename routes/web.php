<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreUserController;
use App\Http\Controllers\AnswerUserController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\sondageController;
use App\Http\Controllers\sondageSachaController;
use App\Http\Controllers\VoteController;
use App\Models\Survey;
use App\Models\Answer;
use App\Models\AnswerUser;
use App\Models\GenreUser;
use App\Models\SurveyControllerSacha;




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


//Route::get('/api/survey-results', [App\Http\Controllers\SurveyControllerSacha::class, 'getSurveyResults']);

// Route principale
Route::get('/', function () { return view('welcome'); })->name('accueil');

// Chat
Route::middleware('auth')->group(function () {

    Route::get('registerbis', [GenreUserController::class, 'showForm'])->name('registerbis');
    Route::post('registerbis', [GenreUserController::class, 'saveGenre']);

    Route::resource("mon-compte", UserController::class);
    Route::post("mon-compte", [UserController::class, 'update']);

    // Route::get('/sondage', [App\Http\Controllers\sondageController::class, 'afficheSondage']);
    Route::get('/sondagesacha', [App\Http\Controllers\sondageSachaController::class, 'afficheSondage'])->name('stats');
    Route::get('/api/survey-results', [App\Http\Controllers\SurveyControllerSacha::class, 'getSurveyResults']);

    Route::get("vote", [AnswerUserController::class, 'showForm'])->name('vote');
    Route::post("vote", [AnswerUserController::class, 'saveAnswer']);

    Route::get('lastsondage', [SurveyController::class, 'lastSurvey'])->name('lastsondage');
    Route::post('storevote',  [AnswerUserController::class, 'storevote'])->name('storevote');

    // Route::get('/refreshhondage', [App\Http\Controllers\sondageController::class, 'refreshSondage']);

    Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'afficheMessage']);
    Route::post('/send-message', [App\Http\Controllers\ChatsController::class, 'enregistrement']);

Route::middleware('admin')->group(function () {
    Route::get('creationsondage', [SurveyController::class, 'showForm'])->name('creationsondage');
    Route::post('creationsondage', [SurveyController::class, 'saveSurvey']);
});

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
