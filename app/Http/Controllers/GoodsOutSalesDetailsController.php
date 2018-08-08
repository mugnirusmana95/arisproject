<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSales;
use App\GoodsSalesDetails;
use App\Good;
use Session;

class GoodsOutSalesDetailsController extends Controller
{
    public function create($id)
    {
      $data['gs'] = GoodsSales::getId($id);
      $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);
      $data['no'] = 1;

      return view('goodsOutSales.detail.create',$data);
    }

    public function store(Request $req, $id)
    {
      $this->validate($req,[
        'goods' => 'required',
      ],[
        'goods.required' => 'Field wajib dipilih',
      ]);

      foreach ($req->goods as $item => $value) {
        GoodsSalesDetails::insertId($value, $id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/sales/detail/tambah/stok/'.$id);
    }

    public function addStock($id)
    {
      $data['gs'] = GoodsSales::getId($id);
      $data['gsd'] = GoodsSalesDetails::getIdGoodsSales($id);
      $data['no'] = 1;

      return view('goodsOutSales.detail.add_stock',$data);
    }

    public function storeStock(Request $req, $id)
    {
      $gsd = GoodsSalesDetails::getIdGoodsSales($id);

      foreach ($req->goods as $item => $value) {
        $id_goods = $req->goods[$item];
        $qyt_box = $req->qyt_box[$item];
        $qyt_pcs = $req->qyt_pcs[$item];
        $desc = $req->description2[$item];

        GoodsSalesDetails::edit($id_goods, $qyt_box, $qyt_pcs, $desc, $req->id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/sales/lihat/'.$req->id);
    }

    public function edit($id)
    {
      $data['gsd']  = GoodsSalesDetails::getId($id);
      $data['gs']   = GoodsSales::getId($data['gsd']->id_goods_sales);
      $data['goods'] = Good::getAllReady();

      return view('goodsOutSales.detail.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'goods'           => 'required',
        'qyt_box'         => 'nullable|max:4|regex:/^[0-9]+$/',
        'qyt_pcs'         => 'nullable|max:4|regex:/^[0-9]+$/',
        'description'     => 'nullable|max:100',
      ],[
        'goods.required'  => 'Field wajib dipilih',
        'qyt_box.max'     => 'Maksimal 4 karekter',
        'qyt_box.regex'   => 'Karakter tidak diijinkan (hanya : 0-9)',
        'qyt_pcs.max'     => 'Maksimal 4 karekter',
        'qyt_pcs.regex'   => 'Karakter tidak diijinkan (hanya : 0-9)',
        'description.max' => 'Maksimal 100 karakter',
      ]);

      GoodsSalesDetails::edit($req->goods, $req->qyt_box, $req->qyt_pcs, $req->description, $req->id_goods_sales);

      return redirect('/barang_keluar/sales/lihat/'.$req->id_goods_sales);
    }

    public function destroy($id)
    {
      GoodsSalesDetails::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return back();
    }
}
