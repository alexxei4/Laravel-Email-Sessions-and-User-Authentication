<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ListSent;
use App\Models\TodoList; 
use Illuminate\Contracts\Mail\Mailable;


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

Auth::routes();
//$todolists = TodoList::where('user_id', Auth::user()->id)->get();
Route::middleware(['auth'])->group(function () {
    Route::get('manage/index',[TodoListController::class,'index'])->name('todolists.index');
    Route::get('manage/create',[TodoListController::class,'create'])->name('todolists.create');
    Route::get('manage/delete',[TodoListController::class,'DeleteAll'])->name('todolists.delete');
    Route::get('manage/restore',[TodoListController::class,'restoreTodoList'])->name('todolists.restore');
    Route::post('manage/store',[TodoListController::class,'store'])->name('todolists.store');
    Route::post('manage/add',[TodoListController::class,'add'])->name('todolists.add');
    Route::post('manage/save',[TodoListController::class,'save'])->name('todolists.save');
});



//Route::get('manage/', 'ManageController@index')->middleware('auth');

Route::get('manage/listsent',function(){
    $user_id = auth()->id();
    $todolists = \App\Models\TodoList::where('user_id', $user_id)->get();

    Mail::to(Auth::user()->email)->send(
        new ListSent($todolists)
);
    return redirect()->route('todolists.index')->with('success', 'TODO list sent to email');
})->name('todolists.listsent');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});
