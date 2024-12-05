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
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TypeQuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AccountController::class, 'list'])->name('account.list');
Route::get('/create', [AccountController::class, 'create'])->name('account.create');
//type
Route::prefix('type')->group(function(){
    Route::get('/list', [TypeQuestionController::class, 'list'])->name('type.list');
    Route::get('/create', [TypeQuestionController::class, 'create'])->name('type.create');
    Route::post('/insert', [TypeQuestionController::class, 'insert'])->name('type.insert');
    Route::get('/edit', [TypeQuestionController::class, 'edit'])->name('type.edit');
    Route::post('/update', [TypeQuestionController::class, 'update'])->name('type.update');
    Route::post('/delete', [TypeQuestionController::class, 'delete'])->name('type.delete');
    Route::get('/trash', [TypeQuestionController::class, 'trash'])->name('type.trash');
    Route::get('/restore', [TypeQuestionController::class, 'restore'])->name('type.restore');
});
//question
Route::prefix('question')->group(function() {
    Route::get('/list', [QuestionController::class, 'list'])->name('question.list');
    Route::get('/detail', [QuestionController::class, 'detail'])->name('question.detail');
    Route::get('/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/insert', [QuestionController::class, 'insert'])->name('question.insert');
    Route::get('/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('/update', [QuestionController::class, 'update'])->name('question.update');
    Route::post('/delete', [QuestionController::class, 'delete'])->name('question.delete');
    Route::get('/trash', [QuestionController::class, 'trash'])->name('question.trash');
    Route::get('/restore', [QuestionController::class, 'restore'])->name('question.restore');
});
