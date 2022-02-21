<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SpecializedController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatisticController;

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
    return redirect('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/statistic/statistic-class', [StatisticController::class, 'statisticClass'])->name('statistic.class');
	Route::get('/statistic/statistic-year', [StatisticController::class, 'statisticYear'])->name('statistic.year');
	Route::get('/statistic/statistic-specialized', [StatisticController::class, 'statisticSpecialized'])->name('statistic.specialized');
	Route::resource('specialized', SpecializedController::class);
	Route::resource('surveys', SurveyController::class);

	Route::resource('classes', ClassesController::class)->only([
	    'index', 'create', 'store', 'destroy'
	]);;
	Route::get('/classes/{classes}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
	Route::put('/classes/{classes}', [ClassesController::class, 'update'])->name('classes.update');
	Route::delete('/classes/{classes}/delete', [ClassesController::class, 'destroy'])->name('classes.destroy');

	Route::resource('questions', QuestionController::class);

	Route::resource('users', UserController::class);
	Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
	Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');

});
require __DIR__.'/auth.php';
