<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSales;
use App\GoodsSalesDetails;
use Session;

class GoodsInSalesController extends Controller
{
    public function index()
    {
      $data['gs'] = GoodsSales::getAll();

      return view('goodsInSales.index',$data);
    }

    public function goodsBack($id)
    {
      $gs = GoodsSales::getId($id);

      if($gs->status==1){
        GoodsSales::goodsBack($id);

        Session::flash('success','Konfirmasi Barang Kembali Telah Berhasil');

        return redirect('/barang_masuk/sales/ubah/'.$id);
      } else {
        Session::flash('warning','Barang telah dikonfirmasi, tidak dapat di konfirmasi ulang');

        return redirect('/barang_masuk/sales/lihat/'.$id);
      }
    }

    public function open($id)
    {
      $gs = GoodsSales::getId($id);

      if ($gs->status==2) {
        $data['gs'] = GoodsSales::getId($id);
        $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);

        return view('goodsInSales.detail', $data);
      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }

    public function edit($id)
    {
      $gs = GoodsSales::getId($id);

      if ($gs->status==2) {
        $data['gs'] = GoodsSales::getId($id);
        $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);
        $data['no'] = 1;

        return view('goodsInSales.edit',$data);
      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }

    public function update(Request $req, $id)
    {
      $gs = GoodsSales::getId($id);

      if ($gs->status==2) {
        $gsd = GoodsSalesDetails::getIdGoodsSales($id);

        foreach ($req->goods as $item => $value) {
          $id_goods = $req->goods[$item];
          $qyt_box = $req->qyt_box[$item];
          $qyt_pcs = $req->qyt_pcs[$item];
          $bad_box = $req->bad_box[$item];
          $bad_pcs = $req->bad_pcs[$item];
          GoodsSalesDetails::editIn($id_goods, $qyt_box, $qyt_pcs, $bad_box, $bad_pcs, $req->id);
        }

        Session::flash('success','Data berhasil disimpan');

        return redirect('/barang_masuk/sales/lihat/'.$req->id);
      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }

    public function destroy($id)
    {
      $gs = GoodsSales::getId($id);

      if ($gs->status==2) {
        GoodsSales::destroy($id);
        $gsd = GoodsSalesDetails::getIdGoodsSales($id);

        if (count($gsd)>0) {
          foreach ($gsd as $item) {
            GoodsSalesDetails::destroyGoodsSalesOut($item->id_goods, $id);
          }
        }

        Session::flash('success','Data berhasil dihapus');

        return redirect('/barang_masuk/sales');

      } else {
        Session::flash('warning','Barang belum dikembalikan, Konfirmasi barang kembali terlebih dahulu');

        return redirect('/barang_masuk/sales');
      }
    }
}
