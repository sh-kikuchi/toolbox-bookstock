<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
/* Theme */
Route::get('/', [App\Http\Controllers\ThemeController::class, 'index'])->name('theme.index');
Route::post('/theme/store', [App\Http\Controllers\ThemeController::class, 'store'])->name('theme.store');
Route::get('/theme/edit/{theme}', [App\Http\Controllers\ThemeController::class, 'edit'])->name('theme.edit');
Route::post('/theme/update', [App\Http\Controllers\ThemeController::class, 'update'])->name('theme.update');
Route::get('/theme/destroy/{theme}', [App\Http\Controllers\ThemeController::class, 'destroy'])->name('theme.destroy');

/* Book */
Route::get('/book/index/{theme}', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');
Route::post('/book/store/{theme}', [App\Http\Controllers\BookController::class, 'store'])->name('book.store');
Route::get('/book/edit/{theme}/{book}', [App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');
Route::post('/book/update', [App\Http\Controllers\BookController::class, 'update'])->name('book.update');
Route::get('/book/destroy/{theme}/{book}', [App\Http\Controllers\BookController::class, 'destroy'])->name('book.destroy');
Route::get('/book/all', [App\Http\Controllers\BookController::class, 'all'])->name('book.all');

/* Review */
Route::get('/review/index/{theme}/{book}', [App\Http\Controllers\ReviewController::class, 'index'])->name('review.index');
Route::post('/review/store/{theme}/{book}', [App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
Route::get('/review/edit/{theme}/{book}/{review}', [App\Http\Controllers\ReviewController::class, 'edit'])->name('review.edit');
Route::post('/review/update', [App\Http\Controllers\ReviewController::class, 'update'])->name('review.update');
Route::get('/review/destroy/{theme}/{book}/{review}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('review.destroy');
Route::get('/review/all/{book}', [App\Http\Controllers\ReviewController::class, 'all'])->name('review.all');

/* Export */
Route::get('/book/export',[App\Http\Controllers\BookController::class,'export'])->name('book.export');
Route::get('/review/export',[App\Http\Controllers\ReviewController::class,'export'])->name('review.export');
