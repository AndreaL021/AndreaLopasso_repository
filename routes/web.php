<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;


// PublicController
Route::get('/', [PublicController::class, 'index'])->name('homepage');

Route::get('/search', [PublicController::class, 'search'])->name('search');

Route::get('/category/view/{category}', [PublicController::class, 'category'])->name('category');

Route::get('/detail/view/{announcement}', [PublicController::class, 'detail'])->name('announcement.detail');


// AnnouncementController
Route::get('/user/announcements', [AnnouncementController::class, 'show'])->name('announcement.show');

Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');

Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');

Route::post('/announcement/images/upload', [AnnouncementController::class, 'uploadImage'])->name('announcement.images.upload');

Route::delete('/announcement/images/remove', [AnnouncementController::class, 'removeImage'])->name('announcement.images.remove');

Route::get('/announcement/images', [AnnouncementController::class, 'getImages'])->name('announcement.images');

Route::get('/announcement/edit/{announcement}', [AnnouncementController::class, 'edit'])->name('announcement.edit');

Route::put('/announcement/{announcement}/update', [AnnouncementController::class, 'update'])->name('announcement.update');

Route::delete('/announcement/{announcement}/delete', [AnnouncementController::class, 'destroy'])->name('announcement.delete');


// RevisorController
Route::get('/revisor/home', [RevisorController::class, 'index'])->name('revisor.home');

Route::post('/revisor/announcement/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');

Route::post('/revisor/announcement/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');

Route::get('/revisor/archive', [RevisorController::class, 'archive'])->name('revisor.archive');

Route::post('/revisor/announcement/{id}/restore', [RevisorController::class, 'restore'])->name('revisor.restore');

Route::post('/revisor/announcement/{id}/delete', [RevisorController::class, 'delete'])->name('revisor.delete');


// ContactController
Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');

Route::post('/contacts/submit', [ContactController::class, 'message'])->name('message');