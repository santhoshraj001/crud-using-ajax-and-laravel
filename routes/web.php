<?php
use App\Http\Controllers\personalDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

        //  ----------this ajax crud operation------------

Route::get('/personal', [personalDetailController::class, 'index'])->name('personal.index');
Route::post('/personal/store', [personalDetailController::class, 'store'])->name('personal.store');
Route::get('/personal/fetchdata', [personalDetailController::class, 'fetchdata'])->name('personal.fetchdata');
Route::get('/personal/edit/{id}', [personalDetailController::class, 'edit'])->name('personal.edit');
Route::post('/personal/update/{id}', [personalDetailController::class, 'update'])->name('personal.update');
Route::get('/personal/delete/{id}', [personalDetailController::class, 'delete'])->name('personal.delete');
Route::post('/personal/delete-selected', [personalDetailController::class, 'deleteselected'])->name('personal.deleteselected');
