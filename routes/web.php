<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CandidateController;

Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'auth'])->name('auth');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/sendotp',[LoginController::class,'sendotp'])->name('sendotp');

Route::get('/checkmail',[LoginController::class,'checkmail'])->name('checkmail');

Route::get('/all-company',[CompanyController::class,'index'])->name('all.company')->middleware(['login']);
Route::get('/companylistdata',[CompanyController::class,'companylistdata'])->name('companylistdata')->middleware(['login']);
Route::post('/add-compant',[CompanyController::class,'add'])->name('add.company')->middleware(['login']);
Route::post('/update-compant',[CompanyController::class,'update'])->name('update.company')->middleware(['login']);

Route::get('/delete',[CompanyController::class,'delete'])->name('company.delete')->middleware(['login']);


Route::get('/all-condidate',[CandidateController::class,'index'])->name('all.condidate')->middleware(['login']);
Route::get('/condidatedata',[CandidateController::class,'getdata'])->name('condidatedata')->middleware(['login']);
Route::post('/save-condidate',[CandidateController::class,'candidatesave'])->name('candidate.save')->middleware(['login']);
Route::post('/save-document',[CandidateController::class,'documentupload'])->name('document.save')->middleware(['login']);
Route::get('/showdocument',[CandidateController::class,'showdocument'])->name('showdocument')->middleware(['login']);

Route::post('/remark-update',[CandidateController::class,'remarkupdate'])->name('remark.update')->middleware(['login']);
Route::post('/name-update',[CandidateController::class,'nameupdate'])->name('name.update')->middleware(['login']);
Route::get('/totalcount',[CandidateController::class,'totalcount'])->middleware(['login']);


Route::get('/suman/{id?}',[LoginController::class,'delete_folder'])->name('delete.folder');