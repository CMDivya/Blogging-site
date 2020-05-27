<?php
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Route::get('/RegisterAdmin', function () {
    return view('auth/RegisterAdmin');
})->name('Admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//admin crud
Route::middleware(['auth', 'admins'])->group(function ()
{
   
    Route::resource('blog', 'BlogController');
    Route::resource('tag', 'TagController')->except('store');
    Route::post('tag/store','TagController@store');

//for category
Route::get('category','CategoryController@index')->name('category.index');
Route::get('category/create','CategoryController@create')->name('category.create');
Route::post('category/store','CategoryController@store')->name('category.store');
Route::get('category/{slug}/edit','CategoryController@edit')->name('category.edit');
Route::put('category/{slug}/update','CategoryController@update')->name('category.update');
Route::delete('category/{slug}/delete','CategoryController@destroy')->name('category.delete');
Route::get('category/{slug}/show', 'CategoryController@show')->name('category.show');

//for permision
Route::get('permission','PermissionController@index')->name('permission.index');

//for role
Route::get('role','RoleController@index')->name('role.index');
Route::post('role/store','RoleController@store')->name('role.store');
Route::get('role/create','RoleController@create')->name('role.create');
Route::get('role/{id}','RoleController@show')->name('role.show');
Route::get('role/{id}/edit','RoleController@edit')->name('role.edit');
Route::put('role/{id}/update','RoleController@update')->name('role.update');
Route::delete('Role/{id}/delete','RoleController@destroy')->name('role.delete');

//for user deatils by admin
Route::get('user','RoleController@index')->name('user.index');
Route::post('user/store','RoleController@store')->name('user.index');
Route::get('user/create','RoleController@create')->name('user.create');
Route::get('user/{id}','RoleController@show')->name('user.show');
Route::get('user/{id}/edit','RoleController@edit')->name('user.edit');
Route::put('user/{id}/update','RoleController@update')->name('user.update');
Route::delete('user/{id}/delete','RoleController@destroy')->name('user.delete');


});

//for comment store
Route::put('blogs/{id}/commentstore','BlogController@commentstore')->name('blogs.cstore');

//for user blog crud 
Route::prefix('users')->name('users.')->middleware(['auth', 'users'])->group(function () {
    Route::get('/categories','CategoryController@userindex')->name('categories.index');
});

