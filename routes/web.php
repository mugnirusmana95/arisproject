<?php

Route::group([
  'middleware' => 'auth',
], function(){
  Route::get('/','DashboardController@index')->name('dashboard');

  Route::group([
    'prefix' => '/master',
  ], function () {
    Route::group([
      'prefix' => '/user'
    ], function(){
      Route::get('/','UserController@index')->name('user.index');
      Route::get('/tambah','UserController@create')->name('user.create');
      Route::post('/tambah/simpan','UserController@store')->name('user.store');
      Route::get('/lihat/{id}','UserController@open')->name('user.open');
      Route::get('/ubah/{id}','UserController@edit')->name('user.edit');
      Route::put('/ubah/simpan/{id}','UserController@update')->name('user.update');
      Route::get('/reset/{id}','UserController@resetPassword')->name('user.resetPassword');
      Route::get('/hapus/{id}','UserController@destroy')->name('user.destroy');
      Route::get('/test/','UserController@test')->name('user.test');
    });

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
        Route::get('/lihat/{id}','GoodsInReturnWarehouseController@open')->name('gi.return.warehouse.open');
        Route::put('/edit_keterangan/simpan/{id}','GoodsInReturnWarehouseController@editDescription')->name('gi.return.warehouse.editDescription');
        Route::get('/hapus/{id}','GoodsInReturnWarehouseController@destroy')->name('gi.return.warehouse.destroy');

        Route::group([
          'prefix' => '/detail',
        ], function(){
          Route::get('/tambah/{id}','GoodsInReturnWarehouseDetailController@create')->name('gi.return.warehouse.addStock');
          Route::post('/tambah/simpan/{id}','GoodsInReturnWarehouseDetailController@store')->name('gi.return.warehouse.addStock');
          Route::get('/tambah/stok/{id}','GoodsInReturnWarehouseDetailController@addStock')->name('gi.return.warehouse.addStock');
          Route::put('/tambah/stok/simpan/{id}','GoodsInReturnWarehouseDetailController@storeStock')->name('gi.return.warehouse.storeStock');
          Route::get('/ubah/{id}','GoodsInReturnWarehouseDetailController@edit')->name('gi.return.warehouse.detail.edit');
          Route::put('/ubah/simpan/{id}','GoodsInReturnWarehouseDetailController@update')->name('gi.return.warehouse.detail.update');
          Route::get('/hapus/{id}','GoodsInReturnWarehouseDetailController@destroy')->name('gi.return.warehouse.detail.destroy');
          Route::get('/cek/barang/{id_barang}/{id_rew}','GoodsInReturnWarehouseDetailController@getOneGoods')->name('gi.return.warehouse.getOneGoods');
        });
      });
    });
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
      Route::get('/cetak/{id}','GoodsOutWarehouseController@print')->name('go.warehouse.print');
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
        Route::get('/cek/barang/{id_barang}/{id_gow}','GoodsOutWarehouseDetailController@getOneGoods')->name('go.warehouse.detail.getOneGoods');
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
      Route::get('/cetak/{id}','GoodsOutSalesController@print')->name('go.sales.print');
      Route::get('/cek/id/{id}','GoodsOutSalesController@getId')->name('go.sales.getId');
      Route::get('/cek/all/retur','GoodsOutSalesController@getAllReturn')->name('go.sales.getAllReturn');

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
        Route::get('/cek/barang/retur/','GoodsOutSalesDetailsController@getGoodsReturn')->name('go.sales.detail.getGoodsReturn');
        Route::get('/cek/barang/{id_barang}/{id_gow}','GoodsOutSalesDetailsController@getOneGoods')->name('go.sales.detail.getOneGoods');
      });
    });
  });

  Route::group([
    'prefix' => '/laporan'
  ], function(){
    Route::group([
      'prefix' => '/hari_ini'
    ], function(){
      Route::get('/','ReportTodayController@index')->name('report.today.index');
      Route::get('/print','ReportTodayController@print')->name('report.today.print');
    });

    Route::group([
      'prefix' => '/barang_masuk'
    ], function(){
      Route::group([
        'prefix' => '/dari_supplier'
      ], function(){
        Route::get('/','ReportGisupController@index')->name('report.gisup.index');
        Route::post('/cek_periode','ReportGisupController@checkPeriode')->name('report.gisup.checkPeriode');
        Route::post('/cek_periode/print_periode','ReportGisupController@printPeriode')->name('report.gisup.printPeriode');
        Route::post('/cek_tanggal','ReportGisupController@checkDate')->name('report.gisup.checkDate');
        Route::post('/cek_tanggal/print_tanggal','ReportGisupController@printDate')->name('report.gisup.printDate');
        Route::post('/cek_hari_ini','ReportGisupController@checkToday')->name('report.gisup.checkToday');
        Route::post('/cek_hari_ini/print_hari_ini','ReportGisupController@printToday')->name('report.gisup.printToday');
      });

      Route::group([
        'prefix' => '/dari_gudang'
      ], function(){
        Route::get('/','ReportGiwareController@index')->name('report.giware.index');
        Route::post('/cek_periode','ReportGiwareController@checkPeriode')->name('report.giware.checkPeriode');
        Route::post('/cek_periode/print_periode','ReportGiwareController@printPeriode')->name('report.giware.printPeriode');
        Route::post('/cek_tanggal','ReportGiwareController@checkDate')->name('report.giware.checkDate');
        Route::post('/cek_tanggal/print_tanggal','ReportGiwareController@printDate')->name('report.giware.printDate');
        Route::post('/cek_hari_ini','ReportGiwareController@checkToday')->name('report.giware.checkToday');
        Route::post('/cek_hari_ini/print_hari_ini','ReportGiwareController@printToday')->name('report.giware.printToday');
      });

      Route::group([
        'prefix' => '/dari_sales'
      ], function(){
        Route::get('/','ReportGisalesController@index')->name('report.gisales.index');
        Route::post('/cek_periode','ReportGisalesController@checkPeriode')->name('report.gisales.checkPeriode');
        Route::post('/cek_periode/print_periode','ReportGisalesController@printPeriode')->name('report.gisales.printPeriode');
        Route::post('/cek_tanggal','ReportGisalesController@checkDate')->name('report.gisales.checkDate');
        Route::post('/cek_tanggal/print_tanggal','ReportGisalesController@printDate')->name('report.gisales.printDate');
        Route::post('/cek_hari_ini','ReportGisalesController@checkToday')->name('report.gisales.checkToday');
        Route::post('/cek_hari_ini/print_hari_ini','ReportGisalesController@printToday')->name('report.gisales.printToday');
      });
    });

    Route::group([
      'prefix' => '/barang_keluar'
    ], function(){
      Route::group([
        'prefix' => '/ke_gudang'
      ], function(){
        Route::get('/','ReportGowareController@index')->name('report.goware.index');
        Route::post('/cek_periode','ReportGowareController@checkPeriode')->name('report.goware.checkPeriode');
        Route::post('/cek_periode/print_periode','ReportGowareController@printPeriode')->name('report.goware.printPeriode');
        Route::post('/cek_tanggal','ReportGowareController@checkDate')->name('report.goware.checkDate');
        Route::post('/cek_tanggal/print_tanggal','ReportGowareController@printDate')->name('report.goware.printDate');
        Route::post('/cek_hari_ini','ReportGowareController@checkToday')->name('report.goware.checkToday');
        Route::post('/cek_hari_ini/print_hari_ini','ReportGowareController@printToday')->name('report.goware.printToday');
      });

      Route::group([
        'prefix' => '/ke_sales'
      ], function(){
        Route::get('/','ReportGosalesController@index')->name('report.gosales.index');
        Route::post('/cek_periode','ReportGosalesController@checkPeriode')->name('report.gosales.checkPeriode');
        Route::post('/cek_periode/print_periode','ReportGosalesController@printPeriode')->name('report.gosales.printPeriode');
        Route::post('/cek_tanggal','ReportGosalesController@checkDate')->name('report.gosales.checkDate');
        Route::post('/cek_tanggal/print_tanggal','ReportGosalesController@printDate')->name('report.gosales.printDate');
        Route::post('/cek_hari_ini','ReportGosalesController@checkToday')->name('report.gosales.checkToday');
        Route::post('/cek_hari_ini/print_hari_ini','ReportGosalesController@printToday')->name('report.gosales.printToday');
      });
    });
  });

  Route::group([
    'prefix' => '/profile',
  ], function(){
    Route::get('/','ProfileController@index')->name('profile.index');
    Route::get('/ubah_data','ProfileController@editData')->name('profile.editData');
    Route::put('/ubah_data/simpan','ProfileController@updateData')->name('profile.updateData');
    Route::get('/ubah_password','ProfileController@editPassword')->name('profile.editPassword');
    Route::put('/ubah_password/simpan','ProfileController@updatePassword')->name('profile.updatePassword');
    Route::get('/ubah_foto','ProfileController@editPicture')->name('profile.editPicture');
    Route::put('/ubah_foto/simpan','ProfileController@updatePicture')->name('profile.updatePicture');
  });
});
Route::group([
  'middleware' => 'guest',
], function(){
  Route::group([
    'prefix' => '/lupa_password'
  ],function(){
    Route::get('/','ForgotPasswordController@index')->name('forgot.index');
    Route::post('/cek_email','ForgotPasswordController@cekEmail')->name('forgot.cekEmail');
    Route::get('/verifikasi_kode/{email}/{code}','ForgotPasswordController@verifyCode')->name('forgot.verifyCode');
    Route::post('/verifikasi_kode/cek/{email}','ForgotPasswordController@storeVerifyCode')->name('forgot.storeVerifyCode');
    Route::get('/kirim_ulang_kode/{email}','ForgotPasswordController@resendCode')->name('forgot.resendCode');
    Route::get('/ubah_password/{email}/{code}','ForgotPasswordController@editPassword')->name('forgot.editPassword');
    Route::put('/ubah_password/simpan/{email}','ForgotPasswordController@updatePassword')->name('forgot.updatePassword');
  });
});

Auth::routes();
