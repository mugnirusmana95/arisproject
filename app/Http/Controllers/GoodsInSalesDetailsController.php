<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSales;
use App\GoodsSalesDetails;
use Session;

class GoodsInSalesDetailsController extends Controller
{
    public function edit($id)
    {
      $gsd = GoodsSalesDetails::getId($id);
      $gs = GoodsSales::getId($gsd->id_goods_sales);
      if ($gs->status == 2) {
        $data['gsd'] = $gsd;
        $data['gs'] = $gs;

        return view('goodsInSales.detail.edit',$data);

      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }

    public function update(Request $req, $id)
    {
      $gsd = GoodsSalesDetails::getId($id);
      $gs = GoodsSales::getId($gsd->id_goods_sales);
      if ($gs->status == 2) {
        $this->validate($req,[
          'qyt_box'             => 'nullable|max:4|regex:/^[0-9]+$/',
          'qyt_pcs'             => 'nullable|max:4|regex:/^[0-9]+$/',
          'bad_stock_pcs'       => 'nullable|max:4|regex:/^[0-9]+$/',
          'bad_stock_pcs'       => 'nullable|max:4|regex:/^[0-9]+$/',
        ],[
          'qyt_box.max'         => 'Maksimal 4 karekter',
          'qyt_box.regex'       => 'Karakter tidak diijinkan (hanya : 0-9)',
          'qyt_pcs.max'         => 'Maksimal 4 karekter',
          'qyt_pcs.regex'       => 'Karakter tidak diijinkan (hanya : 0-9)',
          'bad_stock_box.max'   => 'Maksimal 4 karekter',
          'bad_stock_box.regex' => 'Karakter tidak diijinkan (hanya : 0-9)',
          'bad_stock_pcs.max'   => 'Maksimal 4 karekter',
          'bad_stock_pcs.regex' => 'Karakter tidak diijinkan (hanya : 0-9)',
        ]);

        GoodsSalesDetails::editIn($req->goods, $req->qyt_box, $req->qyt_pcs, $req->bad_stock_box, $req->bad_stock_pcs, $req->id_goods_sales);

        Session::flash('success','Data berhasil diubah');

        return redirect('/barang_masuk/sales/lihat/'.$req->id_goods_sales);

      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }

    public function destroy($id)
    {
      $gsd = GoodsSalesDetails::getId($id);
      $gs = GoodsSales::getId($gsd->id_goods_sales);
      if ($gs->status == 2) {
        GoodsSalesDetails::destroyOut($id);

        Session::flash('success','Data berhasil dihapus');

        return redirect('/barang_masuk/sales/lihat/'.$gs->id);
      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }
}
