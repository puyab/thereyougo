<?php

use App\Http\Controllers\{ProfileController};
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\{RedirectIfNotAuthenticated};

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

Route::middleware('splade')->group(function () {
  // Registers routes to support the interactive components...
  Route::spladeWithVueBridge();

  // Registers routes to support password confirmation in Form and Link components...
  Route::spladePasswordConfirmation();

  // Registers routes to support Table Bulk Actions and Exports...
  Route::spladeTable();

  // Registers routes to support async File Uploads with Filepond...
  Route::spladeUploads();

  Route::view('/', 'pages.index')->name('home');

  Route::middleware(['auth',RedirectIfNotAuthenticated::class])->controller(ProfileController::class)->group(function () {
    Route::view('/profile', 'pages.profile')->name('profile.global');
    Route::view('/settings', 'pages.settings')->name('profile');
    Route::view('/referral_code', 'pages.referral-code')->name('referral_code');
    Route::patch('/settings/details', 'updateDetails')->name('profile.details.update');
    Route::patch('/settings/features', 'updateFeatures')->name('profile.features.update');
    Route::post('/settings/images', 'uploadImages')->name('profile.images.upload');
    Route::get('logout', function () {
      \Illuminate\Support\Facades\Auth::logout();
      \ProtoneMedia\Splade\Facades\Toast::success('You logged out successfully');
      return redirect()->route('home');
    });
  });

  require __DIR__ . '/auth.php';
});
