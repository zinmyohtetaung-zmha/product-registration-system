<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExcelRegisterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NormalRegisterController;

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

Route::get('/login', function () {
    return view('pages.login');
})->name('pages.login');

Route::get('/item-page-lists', function () {
    return view('pages.itemlist');
})->name('page.itemlist');

Route::get('/itemlist/nomal-register', function () {
    return view('pages.normal-register');
})->name('normal.register');

Route::get('/item-details', function () {
    return view('pages.itemDetail');
})->name('items.details');

Route::get('/pdf-down', function () {
    return view('pages.pdfdown');
})->name('pdf.down');

Route::post('/check-employees', "EmployeeController@checkEmployee")->name("check.employee");

Route::get('/', "ItemController@getItems")->name("item.lists");

Route::get('/load-register', "ItemController@loadRegisterData")->name("load.register");

Route::post('/item-lists/create-items', "ItemController@store")->name("store.item");

Route::put('/item-lists/deleted-at', "ItemController@daletedAtUpdate")->name("update.deltedat");

Route::put('/item-lists/deleted-at/inactive/{rowValue}', "ItemController@daletedAtNullUpdate")->name("update.deltedat");

Route::get('/edit-items/{id}', "ItemController@editItem")->name("edit.item");

Route::put('/update-items/{id}', "ItemController@updateItem")->name("update.item");

Route::delete('/delete-items', "ItemController@deleteItem")->name("delete.item");

Route::get('/detail-items/{id}', "ItemController@getItemDetail")->name("detail.item");

Route::POST('/items-fetch', "ItemController@fetch")->name("fetch.item.name");

// Route::get('/item/search','ItemController@search')->name('item.search');

// Route::post('/fetch-item-name', [ItemController::class, 'fetchItemName'])->name('fetch.item.name');


// Route::post('/item-search', "ItemController@search")->name("item.search");

Route::get('/item-search', "ItemController@search")->name("item.search");

// Route::get('/item-lists/load-register', "CategoryController@storeCategory")->name("store.category");########test add category

Route::post('/create-category', "CategoryController@storeCategory")->name("create.category");

Route::post('/delete-category', "CategoryController@deleteCategory")->name("delete.category");

Route::get('/excelformat-down', "ExcelController@export")->name("excelformat.down");

Route::post('/itemexcel-import', "ExcelController@import")->name("itemexcel.import");

Route::get('/locale/{lange}', [LanguageController::class, 'setLang'])->name('lang.change');


Route::get('/autocomplete', 'ItemController@autocomplete')->name('autocomplete');



// Route::get('/excelformat-down', [CategoryController::class, 'export'])->name("excelformat.down");

