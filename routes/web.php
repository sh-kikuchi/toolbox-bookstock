<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/* Theme */
Route::get('/', [App\Http\Controllers\ThemeController::class, 'index'])->name('theme.index');
Route::post('/theme/store', [App\Http\Controllers\ThemeController::class, 'store'])->name('theme.store');
Route::post('/theme/emit/{theme}', [App\Http\Controllers\ThemeController::class, 'emit'])->name('theme.emit');
Route::post('/theme/update/{theme}', [App\Http\Controllers\ThemeController::class, 'update'])->name('theme.update');
Route::post('/theme/destroy/{theme}', [App\Http\Controllers\ThemeController::class, 'destroy'])->name('theme.destroy');

/* Book */
Route::post('/book/index/{book}', [App\Http\Controllers\ThemeController::class, 'index'])->name('book.index');
Route::post('/book/store/{book}', [App\Http\Controllers\ThemeController::class, 'store'])->name('book.store');
Route::post('/book/emit/{book}', [App\Http\Controllers\ThemeController::class, 'emit'])->name('book.emit');
Route::post('/book/update/{book}', [App\Http\Controllers\ThemeController::class, 'update'])->name('book.update');
Route::post('/book/destroy/{book}', [App\Http\Controllers\ThemeController::class, 'destroy'])->name('book.destroy');

/* Review */
Route::post('/review/index/{review}', [App\Http\Controllers\ThemeController::class, 'index'])->name('review.index');
Route::post('/review/store/{review}', [App\Http\Controllers\ThemeController::class, 'store'])->name('review.store');
Route::post('/review/emit/{review}', [App\Http\Controllers\ThemeController::class, 'emit'])->name('review.emit');
Route::post('/review/update/{review}', [App\Http\Controllers\ThemeController::class, 'update'])->name('review.update');
Route::post('/review/destroy/{review}', [App\Http\Controllers\ThemeController::class, 'destroy'])->name('review.destroy');
