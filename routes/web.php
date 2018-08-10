<?php

Route::group([
  // 'middleware' => 'auth', //Validate Login
], function(){
  Route::get('/','DashboardController@index')->name('dashboard');

  Route::group([
    'prefix' => '/master',
  ], function () {
    Route::group([
      'prefix' => '/barang',
    ], function() {
      Route::get('/','GoodController@index')->name('goods.index');
      Route::get('/tambah','GoodController@create')->name('goods.create');
      Route::post('/tambah/simpan','GoodController@store')->name('goods.store');
      Route::get('/ubah/{id}','GoodController@edit')->name('goods.edit');
      Route::put('/ubah/simpan/{id}','GoodController@update')->name('goods.update');
      Route::get('/hapus/{id}','GoodController@destroy')->name('goods.destroy');
      Route::get('/cek/semua/kecuali/barang_keluar/gudang','GoodController@getAllNotInWarehouseOut')->name('goods.getAllNotInWarehouseOut');
      Route::get('/cek/semua/kecuali/barang_keluar/sales','GoodController@getAllNotInSalesOut')->name('goods.getAllNotInSalesOut');
      Route::get('/cek/semua/ready','GoodController@getReady')->name('goods.allready');
      Route::get('/cek/semua/','GoodController@getAll')->name('goods.all');
      Route::get('/cek/stok/{id}','GoodController@checkStock')->name('goods.stock_box');
    });

    Route::group([
      'prefix' => '/supplier',
    ], function() {
      Route::get('/','SupplierController@index')->name('supplier.index');
      Route::get('/tambah','SupplierController@create')->name('supplier.create');
      Route::post('/tambah/simpan','SupplierController@store')->name('supplier.store');
      Route::get('/lihat/{id}','SupplierController@open')->name('supplier.open');
      Route::get('/ubah/{id}','SupplierController@edit')->name('supplier.edit');
      Route::put('/ubah/simpan/{id}','SupplierController@update')->name('supplier.update');
      Route::get('/hapus/{id}','SupplierController@destroy')->name('supplier.destroy');
    });

    Route::group([
      'prefix' => '/gudang',
    ], function(){
      Route::get('/','WarehouseController@index')->name('warehouse.index');
      Route::get('/tambah','WarehouseController@create')->name('warehouse.create');
      Route::post('/tambah/simpan','WarehouseController@store')->name('warehouse.store');
      Route::get('/ubah/{id}','WarehouseController@edit')->name('warehouse.edit');
      Route::put('/ubah/simpan/{id}','WarehouseController@update')->name('warehouse.update');
      Route::get('/hapus/{id}','WarehouseController@destroy')->name('warehouse.delete');
      Route::get('/cek/semua/','WarehouseController@getAll')->name('warehouse.all');
    });

    Route::group([
      'prefix' => '/sales',
    ], function(){
      Route::get('/','SalesController@index')->name('sales.index');
      Route::get('/tambah','SalesController@create')->name('sales.create');
      Route::post('/tambah/simpan','SalesController@store')->name('sales.store');
      Route::get('/lihat/{id}','SalesController@open')->name('sales.open');
      Route::get('/ubah/{id}','SalesController@edit')->name('sales.edit');
      Route::put('/ubah/simpan/{id}','SalesController@update')->name('sales.update');
      Route::get('/hapus/{id}','SalesController@destroy')->name('sales.delete');
      Route::get('/cek/semua/','SalesController@getAll')->name('sales.all');
    });
  });

  Route::group([
    'prefix' => '/barang_masuk',
  ], function() {
    Route::group([
      'prefix' => '/supplier'
    ], function() {
      Route::get('/','GoodsInSupplierController@index')->name('gi.supplier.index');
      Route::get('/tambah','GoodsInSupplierController@create')->name('gi.supplier.create');
      Route::post('/tambah/simpan','GoodsInSupplierController@store')->name('gi.supplier.store');
      Route::get('/lihat/{id}','GoodsInSupplierController@open')->name('gi.supplier.open');
      Route::get('/ubah/{id}','GoodsInSupplierController@edit')->name('gi.supplier.edit');
      Route::put('/ubah/simpan/{id}','GoodsInSupplierController@update')->name('gi.supplier.update');
      Route::get('/hapus/{id}','GoodsInSupplierController@destroy')->name('gi.supplier.destroy');

      Route::group([
        'prefix' => '/detail'
      ], function(){
        Route::get('/tambah/{id_goods_in_supplier}','GoodsInSupplierDetailController@create')->name('gi.supplier.detail.create');
        Route::post('/tambah/simpan/{id_goods_in_supplier}','GoodsInSupplierDetailController@store')->name('gi.supplier.detail.store');
        Route::get('/ubah/{id}','GoodsInSupplierDetailController@edit')->name('gi.supplier.detail.edit');
        Route::put('/ubah/simpan/{id}','GoodsInSupplierDetailController@update')->name('gi.supplier.detail.update');
        Route::get('/hapus/{id}','GoodsInSupplierDetailController@destroy')->name('gi.supplier.detail.destroy');
      });
    });

    Route::group([
      'prefix' => '/gudang',
    ], function(){
      Route::get('/','GoodsInWarehouseController@index')->name('gi.warehouse.index');
      Route::get('/tambah','GoodsInWarehouseController@create')->name('gi.warehouse.create');
      Route::post('/tambah/simpan','GoodsInWarehouseController@store')->name('gi.warehouse.store');
      Route::get('/lihat/{id}','GoodsInWarehouseController@open')->name('gi.warehouse.open');
      Route::get('/ubah/{id}','GoodsInWarehouseController@edit')->name('gi.warehouse.edit');
      Route::put('/ubah/simpan/{id}','GoodsInWarehouseController@update')->name('gi.warehouse.update');
      Route::get('/hapus/{id}','GoodsInWarehouseController@destroy')->name('gi.warehouse.destroy');

      Route::group([
        'prefix' => '/detail',
      ], function(){
        Route::get('/tambah/{id_goods_in_warehouse}','GoodsInWarehouseDetailController@create')->name('gi.warehouse.detail.create');
        Route::post('/tambah/simpan/{id_goods_in_warehouse}','GoodsInWarehouseDetailController@store')->name('gi.warehouse.detail.store');
        Route::get('/ubah/{id}','GoodsInWarehouseDetailController@edit')->name('gi.warehouse.detail.edit');
        Route::put('/ubah/simpan/{id}','GoodsInWarehouseDetailController@update')->name('gi.warehouse.detail.update');
        Route::get('/hapus/{id}','GoodsInWarehouseDetailController@destroy')->name('gi.warehouse.detail.destroy');
      });
    });

    Route::group([
      'prefix' => '/sales',
    ], function(){
      Route::get('/','GoodsInSalesController@index')->name('gi.sales.index');
      Route::get('/lihat/{id}','GoodsInSalesController@open')->name('gi.sales.open');
      Route::get('/kembali/{id}','GoodsInSalesController@goodsBack')->name('gi.sales.goodsBack');
      Route::get('/ubah/{id}','GoodsInSalesController@edit')->name('gi.sales.create');
      Route::post('/ubah/simpan/{id}','GoodsInSalesController@update')->name('gi.sales.store');
      Route::get('/hapus/{id}','GoodsInSalesController@destroy')->name('gi.sales.destroy');

      Route::group([
        'prefix' => '/detail',
      ], function(){
        Route::get('/ubah/{id}','GoodsInSalesDetailsController@edit')->name('gi.sales.detail.edit');
        Route::put('/ubah/simpan/{id}','GoodsInSalesDetailsController@update')->name('gi.sales.detail.update');
        Route::get('/hapus/{id}','GoodsInSalesDetailsController@destroy')->name('gi.sales.detail.destroy');
      });
    });

    Route::group([
      'prefix' => '/retur',
    ], function(){
      Route::group([
        'prefix' => '/gudang',
      ], function(){
        Route::get('/','GoodsInReturnWarehouseController@index')->name('gi.return.warehouse.index');
        Route::get('/tambah','GoodsInReturnWarehouseController@create')->name('gi.return.warehouse.create');
        Route::post('/tambah/simpan','GoodsInReturnWarehouseController@store')->name('gi.return.warehouse.store');
  //       Route::get('/lihat/{id}','GoodsInReturnWarehouseController@open')->name('gi.return.warehouse.open');
  //       Route::get('/ubah/{id}','GoodsInReturnWarehouseController@edit')->name('gi.return.warehouse.edit');
  //       Route::put('/ubah/simpan/{id}','GoodsInReturnWarehouseController@update')->name('gi.return.warehouse.update');
  //       Route::get('/hapus/{id}','GoodsInReturnWarehouseController@destroy')->name('gi.return.warehouse.destroy');

  //       Route::group([
  //         'prefix' => '/detail',
  //       ], function(){
  //         Route::get('/tambah','GoodsInReturnWarehouseDetailController@create')->name('gi.return.warehouse.detail.create');
  //         Route::post('/tambah/simpan','GoodsInReturnWarehouseDetailController@store')->name('gi.return.warehouse.detail.store');
  //         Route::get('/ubah/{id}','GoodsInReturnWarehouseDetailController@edit')->name('gi.return.warehouse.detail.edit');
  //         Route::put('/ubah/simpan/{id}','GoodsInReturnWarehouseDetailController@update')->name('gi.return.warehouse.detail.update');
  //         Route::get('/hapus/{id}','GoodsInReturnWarehouseDetailController@destroy')->name('gi.return.warehouse.detail.destroy');
        });
      });

  //     Route::group([
  //       'prefix' => '/sales'
  //     ], function(){
  //       Route::get('/','GoodsInReturnSalesController@index')->name('gi.return.sales.index');
  //       Route::get('/tambah','GoodsInReturnSalesController@create')->name('gi.return.sales.create');
  //       Route::post('/tambah/simpan','GoodsInReturnSalesController@store')->name('gi.return.sales.store');
  //       Route::get('/lihat/{id}','GoodsInReturnSalesController@open')->name('gi.return.sales.open');
  //       Route::get('/ubah/{id}','GoodsInReturnSalesController@edit')->name('gi.return.sales.edit');
  //       Route::put('/ubah/simpan/{id}','GoodsInReturnSalesController@update')->name('gi.return.sales.update');
  //       Route::get('/hapus/{id}','GoodsInReturnSalesController@destroy')->name('gi.return.sales.destroy');

  //       Route::group([
  //         'prefix' => '/detail',
  //       ], function(){
  //         Route::get('/tambah','GoodsInReturnSalesDetailController@create')->name('gi.return.sales.detail.create');
  //         Route::post('/tambah/simpan','GoodsInReturnSalesDetailController@store')->name('gi.return.sales.detail.store');
  //         Route::get('/ubah/{id}','GoodsInReturnSalesDetailController@edit')->name('gi.return.sales.detail.edit');
  //         Route::put('/ubah/simpan/{id}','GoodsInReturnSalesDetailController@update')->name('gi.return.sales.detail.update');
  //         Route::get('/hapus/{id}','GoodsInReturnSalesDetailController@destroy')->name('gi.return.sales.detail.destroy');
  //       });
  //     });
  //   });
  });

  Route::group([
    'prefix' => '/barang_keluar',
  ], function(){
    Route::group([
      'prefix' => '/gudang',
    ], function(){
      Route::get('/','GoodsOutWarehouseController@index')->name('go.warehouse.index');
      Route::get('/tambah','GoodsOutWarehouseController@create')->name('go.warehouse.create');
      Route::post('/tambah/simpan','GoodsOutWarehouseController@store')->name('go.warehouse.store');
      Route::get('/tambah/stok/{id}','GoodsOutWarehouseController@addStock')->name('go.warehouse.addStock');
      Route::put('/tambah/stok/simpan/{id}','GoodsOutWarehouseController@storeStock')->name('go.warehouse.storeStock');
      Route::get('/lihat/{id}','GoodsOutWarehouseController@open')->name('go.warehouse.open');
      Route::get('/ubah/{id}','GoodsOutWarehouseController@edit')->name('go.warehouse.edit');
      Route::put('/ubah/simpan/{id}','GoodsOutWarehouseController@update')->name('go.warehouse.update');
      Route::get('/hapus/{id}','GoodsOutWarehouseController@destroy')->name('go.warehouse.destroy');
      Route::get('/cek/id/{id}','GoodsOutWarehouseController@getId')->name('go.warehouse.getId');
      Route::get('/cek/all/retur','GoodsOutWarehouseController@getAllReturn')->name('go.warehouse.getIdReturn');

      Route::group([
        'prefix' => '/detail',
      ], function(){
        Route::get('/tambah/{id}','GoodsOutWarehouseDetailController@create')->name('go.warehouse.detail.create');
        Route::post('/tambah/simpan/{id}','GoodsOutWarehouseDetailController@store')->name('go.warehouse.detail.store');
        Route::get('/tambah/stok/{id}','GoodsOutWarehouseDetailController@addStock')->name('go.warehouse.detail.addStock');
        Route::put('/tambah/stok/simpan/{id}','GoodsOutWarehouseDetailController@storeStock')->name('go.warehouse.detail.storeStock');
        Route::get('/ubah/{id}','GoodsOutWarehouseDetailController@edit')->name('go.warehouse.detail.edit');
        Route::put('/ubah/simpan/{id}','GoodsOutWarehouseDetailController@update')->name('go.warehouse.detail.update');
        Route::get('/hapus/{id}','GoodsOutWarehouseDetailController@destroy')->name('go.warehouse.detail.destroy');
        Route::get('/cek/barang/retur/','GoodsOutWarehouseDetailController@getGoodsReturn')->name('go.warehouse.detail.getGoodsReturn');

      });
    });

    Route::group([
      'prefix' => '/sales',
    ], function(){
      Route::get('/','GoodsOutSalesController@index')->name('go.sales.index');
      Route::get('/tambah','GoodsOutSalesController@create')->name('go.sales.create');
      Route::post('/tambah/simpan','GoodsOutSalesController@store')->name('go.sales.store');
      Route::get('/tambah/stok/{id}','GoodsOutSalesController@addStock')->name('go.sales.addStock');
      Route::put('/tambah/stok/simpan/{id}','GoodsOutSalesController@storeStock')->name('go.sales.storeStock');
      Route::get('/lihat/{id}','GoodsOutSalesController@open')->name('go.sales.open');
      Route::get('/ubah/{id}','GoodsOutSalesController@edit')->name('go.sales.edit');
      Route::put('/ubah/simpan/{id}','GoodsOutSalesController@update')->name('go.sales.update');
      Route::get('/hapus/{id}','GoodsOutSalesController@destroy')->name('go.sales.destroy');

      Route::group([
        'prefix' => '/detail',
      ], function(){
        Route::get('/tambah/{id}','GoodsOutSalesDetailsController@create')->name('go.sales.detail.create');
        Route::post('/tambah/simpan/{id}','GoodsOutSalesDetailsController@store')->name('go.sales.detail.store');
        Route::get('/tambah/stok/{id}','GoodsOutSalesDetailsController@addStock')->name('go.sales.detail.addStock');
        Route::put('/tambah/stok/simpan/{id}','GoodsOutSalesDetailsController@storeStock')->name('go.sales.detail.storeStock');
        Route::get('/ubah/{id}','GoodsOutSalesDetailsController@edit')->name('go.sales.detail.edit');
        Route::put('/ubah/simpan/{id}','GoodsOutSalesDetailsController@update')->name('go.sales.detail.update');
        Route::get('/hapus/{id}','GoodsOutSalesDetailsController@destroy')->name('go.sales.detail.destroy');
      });
    });
  });
});
