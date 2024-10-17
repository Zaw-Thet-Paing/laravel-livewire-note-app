<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\User\Home;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('/', Login::class)->name('login');
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware('auth')->group(function(){
    Route::get('/home', Home::class)->name('user.home');
    Route::get('/profile', Profile::class)->name('user.profile');
});
