<?php

use App\Http\Controllers\Auth\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('locale');
Route::post('register', [RegisterController::class, 'register']);

Route::get('lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');


Route::get('success', function () {
    $user = Session::get('registered_user');
    return view('success', ['user' => $user]);
})->name('success')->middleware('locale');