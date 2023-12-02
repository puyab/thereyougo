<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Mail, Route};
use App\Jobs\{RegisterUserToBrevo};
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("queue", function () {
  $user = User::query()->with('profile')->first();
  dispatch(new RegisterUserToBrevo($user));
  return 'Hello World';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
