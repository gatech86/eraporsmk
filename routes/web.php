<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Mail\MyTestMail;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use App\Http\Livewire\Posts;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

//User Managemen All ROute
Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add', [UserController::class, 'UserAdd'])->name('user.add');
    Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');

    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');
});



Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('gustifafauzan86@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});

Route::get('importExportView', [MyController::class, 'importExportView']);
Route::get('export', [MyController::class, 'export'])->name('export');
Route::post('import', [MyController::class, 'import'])->name('import');


Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Route::middleware(['auth:sanctum', 'verified'])->get('post', Posts::class);


Route::middleware(['auth:sanctum', 'verified'])->get('firebase-phone-authentication', [FirebaseController::class, 'index']);
