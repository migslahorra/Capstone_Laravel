<?php

// Path: routes/web.php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\MapController;

// Import the necessary classes
Route::get('/', function () {
    return view('home'); // Home page
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Registration Routes //
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); // Authenticated users only

// properties Page //
Route::get('/properties', function () {
    return view('properties');
})->middleware(['auth'])->name('properties'); // Authenticated users only

// Map Page //
Route::get('/map', function () {
    return view('map');
})->middleware(['auth'])->name('map'); // Authenticated users only

// Saved Properties Page //
Route::get('/saved_properties', function () {
    return view('saved_properties');
})->middleware(['auth'])->name('saved_properties'); // Authenticated users only

// Notifications Page //
Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth'])->name('notifications'); // Authenticated users only

// Messages Page //
Route::get('/messages', function () {
    return view('messages');
})->middleware(['auth'])->name('messages'); // Authenticated users only

// Preferences Page //
Route::get('/preferences', function () {
    return view('preferences');
})->middleware(['auth'])->name('preferences'); // Authenticated users only

Route::get('/upload-property-form', function () {
    return view('upload-property-form');
})->middleware(['auth'])->name('upload-property'); // Authenticated users only

// Verification of email //
Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Authentication Routes //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // This is for user profile //
    Route::patch('/user-profiles', [UserProfileController::class, 'update'])->name('user_profiles.update');

    // This is for the upload property form //
    Route::get('/map', [MapController::class, 'index'])->name('map');
    Route::get('/upload-property', [PropertyController::class, 'create'])->name('upload.property.form');
    Route::post('/upload-property', [PropertyController::class, 'store'])->name('upload.property.store');

    // This is for the map //
    Route::get('/map', [PropertyController::class, 'showMap'])->name('map');

    // This is for the properties //
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties');
});

require __DIR__.'/auth.php';
