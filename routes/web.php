<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PublisherExportExcel;
use App\Http\Controllers\PublishersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('categories', CategoriesController::class)->middleware('auth');

Route::resource('publishers', PublishersController::class)->except('show')->middleware('auth');

Route::get('publishers/export-excel', PublisherExportExcel::class)->name('publishers.export-excel')->middleware('auth');

Route::resource('books', BooksController::class)->middleware('auth');

require __DIR__.'/auth.php';


