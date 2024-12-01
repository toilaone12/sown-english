<?php


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

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TypeQuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AccountController::class, 'list'])->name('account.list');
Route::get('/create', [AccountController::class, 'create'])->name('account.create');
Route::get('/list', [TypeQuestionController::class, 'list'])->name('type.list');
Route::get('/create', [TypeQuestionController::class, 'create'])->name('type.create');
Route::get('/insert', [TypeQuestionController::class, 'insert'])->name('type.insert');
Route::post('/delete', [TypeQuestionController::class, 'delete'])->name('type.delete');
Route::get('/trash', [TypeQuestionController::class, 'trash'])->name('type.trash');
Route::get('/restore', [TypeQuestionController::class, 'restore'])->name('type.restore');
