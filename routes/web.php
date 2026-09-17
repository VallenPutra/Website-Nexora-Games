<?php

use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/captcha-refresh', function () {
    request()->session()->forget('contact_captcha');

    return redirect()->to(route('contact').'#contact-form');
})->name('contact.captcha-refresh');

Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::get('/chat/poll', [ChatController::class, 'poll'])->name('chat.poll');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('games', GameController::class)->except(['show']);

    Route::get('/chat', [AdminChatController::class, 'index'])->name('chat');
    Route::get('/chat/{session}', [AdminChatController::class, 'show'])->name('chat.show');
    Route::get('/chat/{session}/poll', [AdminChatController::class, 'poll'])->name('chat.poll');
    Route::post('/chat/{session}/reply', [AdminChatController::class, 'reply'])->name('chat.reply');
});
