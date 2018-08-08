<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSales;
use App\GoodsSalesDetails;
use Session;

class GoodsOutSalesController extends Controller
{
    public function index()
    {
      $data['gs'] = GoodsSales::getAll();

      return view('goodsOutSales.index',$data);
    }

    public function create()
    {
      return view('goodsOutSales.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'sales' => 'required',
        'goods' => 'required',
      ],[
        'sales.required' => 'Field wajib dipilih',
        'goods.required' => 'Field wajib dipilih',
      ]);

      $id = GoodsSales::getNewId();

      GoodsSales::insert($id, $req->sales, $req->description);

      foreach ($req->goods as $item => $value) {
        GoodsSalesDetails::insertId($value, $id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/sales/tambah/stok/'.$id);
    }

    public function addStock($id)
    {
      $data['gs'] = GoodsSales::find($id);
      $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);
      $data['no'] = 1;

      return view('goodsOutSales.add_stock',$data);
    }

    public function storeStock(Request $req, $id)
    {
      $gsd = GoodsSalesDetails::getIdGoodsSales($req->id);

      foreach ($req->goods as $item => $value) {
        $id_goods = $req->goods[$item];
        $qyt_box = $req->qyt_box[$item];
        $qyt_pcs = $req->qyt_pcs[$item];
        $desc = $req->description2[$item];

        GoodsSalesDetails::edit($id_goods, $qyt_box, $qyt_pcs, $desc, $req->id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/sales/lihat/'.$id);
    }

    public function open($id)
    {
      $data['gs'] = GoodsSales::getId($id);
      $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);

      return view('goodsOutSales.detail',$data);
    }

    public function edit($id)
    {
      $data['gs'] = GoodsSales::getId($id);

      return view('goodsOutSales.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'sales' => 'required',
      ],[
        'sales.required' => 'Field wajib dipilih',
      ]);

      GoodsSales::edit($id, $req->sales, $req->description);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/sales/lihat/'.$id);
    }

    public function destroy($id)
    {
      GoodsSales::destroy($id);

      $gsd = GoodsSalesDetails::getIdGoodsSales($id);
      if (count($gsd)>0) {
        foreach ($gsd as $item) {
          GoodsSalesDetails::destroyGoodsSales($id);
        }
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/sales');
    }
}
