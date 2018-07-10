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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard','DashboardController@index');

Route::group([
  'prefix' => '/master',
], function () {
  Route::group([
    'prefix' => '/barang',
  ], function() {
    Route::get('/','GoodController@index');
    Route::get('/tambah','GoodController@create');
    Route::post('/tambah/simpan','GoodController@store');
    Route::get('/ubah/{id}','GoodController@edit');
    Route::put('/ubah/simpan/{id}','GoodController@update');
    Route::get('/hapus/{id}','GoodController@destroy');
  });

  Route::group([
    'prefix' => '/supplier',
  ], function() {
    Route::get('/','SupplierController@index');
    Route::get('/tambah','SupplierController@create');
    Route::post('/tambah/simpan','SupplierController@store');
    Route::get('/ubah/{id}','SupplierController@edit');
    Route::put('/ubah/simpan/{id}','SupplierController@update');
    Route::get('/hapus/{id}','SupplierController@destroy');
  });
});

Route::group([
  'prefix' => '/barang_masuk',
], function() {
  Route::group([
    'prefix' => '/supplier'
  ], function() {
    Route::get('/','GoodsInSupplierController@index');
    Route::get('/tambah','GoodsInSupplierController@create');
    Route::post('/tambah/simpan','GoodsInSupplierController@store');
    Route::get('/lihat/{id}','GoodsInSupplierController@open');
    Route::get('/ubah/{id}','GoodsInSupplierController@edit');
    Route::put('/ubah/simpan/{id}','GoodsInSupplierController@update');
    Route::get('/hapus/{id}','GoodsInSupplierController@destroy');

    Route::group([
      'prefix' => '/detail'
    ], function(){
      Route::get('/tambah/{id_goods_in_supplier}','GoodsInSupplierDetailController@create');
      Route::post('/tambah/simpan/{id_goods_in_supplier}','GoodsInSupplierDetailController@store');
      Route::get('/ubah/{id}','GoodsInSupplierDetailController@edit');
      Route::put('/ubah/simpan/{id}','GoodsInSupplierDetailController@update');
      Route::get('/hapus/{id}','GoodsInSupplierDetailController@destroy');
    });
  });
});
