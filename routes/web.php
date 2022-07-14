<?php

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

Route::resource('collections', \App\Http\Controllers\CollectionsController::class)
    ->only(['index', 'show']);
Route::resource('snippets', \App\Http\Controllers\SnippetsController::class)
    ->only(['index', 'show']);
Route::resource('tags', \App\Http\Controllers\TagsController::class)
    ->parameters(['tags' => 'tag:title'])
    ->only(['index', 'show']);

require __DIR__ . '/auth.php';
