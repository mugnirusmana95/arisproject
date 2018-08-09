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
      GoodsSales::goodsBack($id);

      Session::flash('success','Barang Telah Dikembalikan');

      return redirect('/barang_masuk/sales/ubah/'.$id);
    }

    public function open($id)
    {
      $data['gs'] = GoodsSales::getId($id);
      $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);

      return view('goodsInSales.detail', $data);
    }

    public function edit($id)
    {
      $data['gs'] = GoodsSales::getId($id);
      $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);
      $data['no'] = 1;

      return view('goodsInSales.edit',$data);
    }

    public function update(Request $req, $id)
    {
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

      return redirect('/barang_masuk/sales/tambah/'.$req->id);
    }
}
