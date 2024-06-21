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

Route::get('/uploads/tasks/{id}/{filename}', function ($id,$filename)
{
    $path = storage_path('app/public/uploads/tasks/'.$id.'/'.$filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

/*
======================== AUTH ========================
*/

Auth::routes();

Route::get('/register','App\Http\Controllers\RegController@showRegForm');
Route::post('/registration','App\Http\Controllers\RegController@register');

Route::post('/logout','App\Http\Controllers\Auth\LoginController@logout');

/*
======================== FRONT ========================
*/

Route::get('/','App\Http\Controllers\ListsController@index');

Route::get('/lists','App\Http\Controllers\ListsController@lists_list');
Route::get('/lists/new','App\Http\Controllers\ListsController@lists_new');
Route::post('/lists/save','App\Http\Controllers\ListsController@lists_save');
Route::get('/lists/edit/{id}','App\Http\Controllers\ListsController@lists_edit');
Route::get('/lists/view/{id}','App\Http\Controllers\ListsController@lists_view');
Route::post('/lists/update','App\Http\Controllers\ListsController@lists_update');
Route::any('/lists/remove/{id}','App\Http\Controllers\ListsController@lists_remove');


Route::post('/lists/add_taks','App\Http\Controllers\TasksController@add_task')->name('add_task');
Route::post('/lists/add_task_text','App\Http\Controllers\TasksController@add_task_text')->name('add_task_text');
Route::post('/lists/add_task_tags','App\Http\Controllers\TasksController@add_task_tags')->name('add_task_tags');

Route::post('/lists/add_task_image','App\Http\Controllers\TasksController@add_task_image')->name('add_task_image');
Route::post('/lists/del_task_image','App\Http\Controllers\TasksController@del_task_image')->name('del_task_image');

