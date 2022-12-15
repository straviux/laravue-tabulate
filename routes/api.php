<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/events', \App\Http\Controllers\EventsController::class);
    Route::resource('/contests', \App\Http\Controllers\ContestController::class);
    Route::resource('/criterias', \App\Http\Controllers\CriteriaController::class);
    Route::resource('/judges', \App\Http\Controllers\JudgesController::class);
    Route::resource('/contestants', \App\Http\Controllers\ContestantsController::class);
    Route::resource('/scores', \App\Http\Controllers\ScoreController::class);
    Route::put('/update-scores', [\App\Http\Controllers\ScoreController::class, 'updateScores']);

    Route::get('/contest-by-event', [\App\Http\Controllers\ContestController::class, 'getByEvent']);
    Route::get('/score-by-judge-contestant', [\App\Http\Controllers\ScoreController::class, 'getByJudgeAndContestant']);
    Route::get('/score-by-judge', [\App\Http\Controllers\ScoreController::class, 'getByJudge']);
    Route::get('/contestants-by-judge', [\App\Http\Controllers\ContestantsController::class, 'getByJudge']);
    Route::get('/finalresult', [\App\Http\Controllers\ScoreController::class, 'getFinalResult']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', function () {
    return json_encode('welcome');
});
