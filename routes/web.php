<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\ControllerBook;
use App\Http\Controllers\IssuedBookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ControllerPublisher;
use App\Http\Controllers\ControllerReport;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ControllerStudent;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
})->middleware('guest');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/Change-password', [LoginController::class, 'changePassword'])->name('change_password');


Route::middleware('auth')->group(function () {
    Route::get('change-password',[dashboardController::class,'change_password_view'])->name('change_password_view');
    Route::post('change-password',[dashboardController::class,'change_password'])->name('change_password');
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // author CRUD
    Route::get('/authors', [AutherController::class, 'index'])->name('authors');
    Route::get('/authors/create', [AutherController::class, 'create'])->name('authors.create');
    Route::get('/authors/edit/{auther}', [AutherController::class, 'edit'])->name('authors.edit');
    Route::post('/authors/update/{id}', [AutherController::class, 'update'])->name('authors.update');
    Route::post('/authors/delete/{id}', [AutherController::class, 'destroy'])->name('authors.destroy');
    Route::post('/authors/create', [AutherController::class, 'store'])->name('authors.store');

    // publisher crud
    Route::get('/publishers', [ControllerPublisher::class, 'index'])->name('publishers');
    Route::get('/publisher/create', [ControllerPublisher::class, 'create'])->name('publisher.create');
    Route::get('/publisher/edit/{publisher}', [ControllerPublisher::class, 'edit'])->name('publisher.edit');
    Route::post('/publisher/update/{id}', [ControllerPublisher::class, 'update'])->name('publisher.update');
    Route::post('/publisher/delete/{id}', [ControllerPublisher::class, 'destroy'])->name('publisher.destroy');
    Route::post('/publisher/create', [ControllerPublisher::class, 'store'])->name('publisher.store');

    // Category CRUD
    Route::get('/categories', [BookCategoryController::class, 'index'])->name('categories');
    Route::get('/category/create', [BookCategoryController::class, 'create'])->name('category.create');
    Route::get('/category/edit/{category}', [BookCategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [BookCategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete/{id}', [BookCategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/create', [BookCategoryController::class, 'store'])->name('category.store');




    // books CRUD
    Route::get('/books', [ControllerBook::class, 'index'])->name('books');
    Route::get('/book/create', [ControllerBook::class, 'create'])->name('book.create');
    Route::get('/book/edit/{book}', [ControllerBook::class, 'edit'])->name('book.edit');
    Route::post('/book/update/{id}', [ControllerBook::class, 'update'])->name('book.update');
    Route::post('/book/delete/{id}', [ControllerBook::class, 'destroy'])->name('book.destroy');
    Route::post('/book/create', [ControllerBook::class, 'store'])->name('book.store');

    // students CRUD
    Route::get('/students', [ControllerStudent::class, 'index'])->name('students');
    Route::get('/student/create', [ControllerStudent::class, 'create'])->name('student.create');
    Route::get('/student/edit/{student}', [ControllerStudent::class, 'edit'])->name('student.edit');
    Route::post('/student/update/{id}', [ControllerStudent::class, 'update'])->name('student.update');
    Route::post('/student/delete/{id}', [ControllerStudent::class, 'destroy'])->name('student.destroy');
    Route::post('/student/create', [ControllerStudent::class, 'store'])->name('student.store');
    Route::get('/student/show/{id}', [ControllerStudent::class, 'show'])->name('student.show');



    Route::get('/book_issue', [IssuedBookController::class, 'index'])->name('book_issued');
    Route::get('/book-issue/create', [IssuedBookController::class, 'create'])->name('book_issue.create');
    Route::get('/book-issue/edit/{id}', [IssuedBookController::class, 'edit'])->name('book_issue.edit');
    Route::post('/book-issue/update/{id}', [IssuedBookController::class, 'update'])->name('book_issue.update');
    Route::post('/book-issue/delete/{id}', [IssuedBookController::class, 'destroy'])->name('book_issue.destroy');
    Route::post('/book-issue/create', [IssuedBookController::class, 'store'])->name('book_issue.store');

    Route::get('/reports', [ControllerReport::class, 'index'])->name('reports');
    Route::get('/reports/Date-Wise', [ControllerReport::class, 'date_wise'])->name('reports.date_wise');
    Route::post('/reports/Date-Wise', [ControllerReport::class, 'generate_date_wise_report'])->name('reports.date_wise_generate');
    Route::get('/reports/monthly-Wise', [ControllerReport::class, 'month_wise'])->name('reports.month_wise');
    Route::post('/reports/monthly-Wise', [ControllerReport::class, 'generate_month_wise_report'])->name('reports.month_wise_generate');
    Route::get('/reports/not-returned', [ControllerReport::class, 'not_returned'])->name('reports.not_returned');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings');
});
