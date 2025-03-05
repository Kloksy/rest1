<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\EstablishmentController;

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
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/establishment/{id}', [EstablishmentController::class, 'card'])->name('establishment.card');

Auth::routes();

Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('establishments', App\Http\Controllers\EstablishmentController::class);

Route::resource('contacts', App\Http\Controllers\ContactController::class);

Route::resource('cuisines', App\Http\Controllers\CuisineController::class);

Route::resource('photos', App\Http\Controllers\PhotoController::class);

Route::resource('establishment-types', App\Http\Controllers\EstablishmentTypeController::class);
Route::resource('establishmentTypes', App\Http\Controllers\EstablishmentTypeController::class);

Route::resource('working-hours', App\Http\Controllers\WorkingHourController::class);
Route::resource('workingHours', App\Http\Controllers\WorkingHourController::class);

Route::resource('general-infos', App\Http\Controllers\GeneralInfoController::class);
Route::resource('generalInfos', App\Http\Controllers\GeneralInfoController::class);

Route::resource('user-reviews', App\Http\Controllers\UserReviewController::class);
Route::resource('userReviews', App\Http\Controllers\UserReviewController::class);

Route::resource('yandex-reviews', App\Http\Controllers\YandexReviewController::class);
Route::resource('yandexReviews', App\Http\Controllers\YandexReviewController::class);

Route::resource('user-preferences', App\Http\Controllers\UserPreferenceController::class);
Route::resource('userPreferences', App\Http\Controllers\UserPreferenceController::class);

Route::resource('user-preferred-cuisines', App\Http\Controllers\UserPreferredCuisineController::class);
Route::resource('userPreferredCuisines', App\Http\Controllers\UserPreferredCuisineController::class);

Route::resource('user-preferred-general-infos', App\Http\Controllers\UserPreferredGeneralInfoController::class);
Route::resource('userPreferredGeneralInfos', App\Http\Controllers\UserPreferredGeneralInfoController::class);

Route::resource('user-preferred-types', App\Http\Controllers\UserPreferredTypeController::class);
Route::resource('userPreferredTypes', App\Http\Controllers\UserPreferredTypeController::class);

Route::resource('user-interactions', App\Http\Controllers\UserInteractionController::class);
Route::resource('userInteractions', App\Http\Controllers\UserInteractionController::class);

Route::resource('roles', App\Http\Controllers\RoleController::class);
