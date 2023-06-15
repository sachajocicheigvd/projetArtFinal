<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreUserController;
use App\Http\Controllers\AnswerUserController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\CreateAdminController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/', function () {
    return view('welcome')->with('messageValidation', '');
})->name('accueil');

// Cette route est utile lorsque l'on est authentifié et que l'on tape /login dans l'url parce qu'il redirige automatiquement vers /dashboard
// donc cette route contourne le problème
Route::get('/dashboard', function () {
    return redirect()->route('accueil');
});


// Authentifiés
Route::middleware('auth')->group(function () {

    Route::get('registerbis', [GenreUserController::class, 'showForm'])->name('registerbis');
    Route::post('registerbis', [GenreUserController::class, 'saveGenre']);

    Route::get("mon-compte", [UserController::class, 'index'])->name('moncompte');
    Route::post("mon-compte", [UserController::class, 'update']);

    // Route::get('/sondage', [App\Http\Controllers\sondageController::class, 'afficheSondage']);
    Route::get('/stats', [App\Http\Controllers\sondageSachaController::class, 'afficheSondage'])->name('stats');
    Route::get('/api/survey-results', [App\Http\Controllers\SurveyControllerSacha::class, 'getSurveyResults']);

    Route::get("vote", [AnswerUserController::class, 'showForm'])->name('vote');
    Route::post("vote", [AnswerUserController::class, 'saveAnswer']);

    Route::get('lastsondage', [SurveyController::class, 'lastSurvey'])->name('lastsondage');
    Route::post('storevote',  [AnswerUserController::class, 'storevote'])->name('storevote');

    // Route::get('/refreshhondage', [App\Http\Controllers\sondageController::class, 'refreshSondage']);

    Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'afficheMessage'])->name('chat');
    Route::post('/send-message', [App\Http\Controllers\ChatsController::class, 'enregistrement']);

    // Admin (dans authentifiés)
    Route::middleware('admin')->group(function () {
        Route::get('creation-sondage', [SurveyController::class, 'showForm'])->name('creationsondage');
        Route::post('creation-sondage', [SurveyController::class, 'saveSurvey']);

        Route::get('createadmin', function () {
            return view('createadmin');
        })->name('createadmin');

Route::post('createadmin', [CreateAdminController::class, 'store']);
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
