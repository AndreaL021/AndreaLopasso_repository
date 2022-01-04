<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;

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

Route::get('/', [PublicController::class, 'index'])->name('homepage');

Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');

Route::post('/contacts/submit', [ContactController::class, 'message'])->name('message');

Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');

Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');

Route::get('/category/view/{category}', [PublicController::class, 'category'])->name('category');

Route::get('/revisor/home', [RevisorController::class, 'index'])->name('revisor.home');

Route::post('/revisor/announcement/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');

Route::post('/revisor/announcement/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');
