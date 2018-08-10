<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsOutWarehouse;
use App\GoodsOutWarehouseDetail;
use App\Good;
use Session;

class GoodsOutWarehouseDetailController extends Controller
{
    public function create($id)
    {
      $data['gow'] = GoodsOutWarehouse::getId($id);
      $data['gowd'] = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($id);
      $data['no'] = 1;

      return view('goodsOutWarehouse.detail.create',$data);
    }

    public function store(Request $req, $id)
    {
      $this->validate($req,[
        'goods' => 'required',
      ],[
        'goods.required' => 'Field wajib dipilih',
      ]);

      foreach ($req->goods as $item => $value) {
        GoodsOutWarehouseDetail::insertId($value, $id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/gudang/detail/tambah/stok/'.$id);
    }

    public function addStock($id)
    {
      $data['gow'] = GoodsOutWarehouse::find($id);
      $data['gowd'] = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($id);
      $data['no'] = 1;

      return view('goodsOutWarehouse.detail.add_stock',$data);
    }

    public function storeStock(Request $req, $id)
    {
      $gowd = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($id);

      foreach ($req->goods as $item => $value) {
        $id_goods = $req->goods[$item];
        $qyt_box = $req->qyt_box[$item];
        $qyt_pcs = $req->qyt_pcs[$item];
        $desc = $req->description2[$item];

        GoodsOutWarehouseDetail::edit($id_goods, $qyt_box, $qyt_pcs, $desc, $req->id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/gudang/lihat/'.$req->id);
    }

    public function edit($id)
    {
      $data['gowd']  = GoodsOutWarehouseDetail::getId($id);
      $data['gow']   = GoodsOutWarehouse::getId($data['gowd']->id_goods_out_warehouse);
      $data['goods'] = Good::getAllReady();

      return view('goodsOutWarehouse.detail.edit',$data);
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

      GoodsOutWarehouseDetail::edit($req->goods, $req->qyt_box, $req->qyt_pcs, $req->description, $req->id_goods_out_warehouse);

      return redirect('/barang_keluar/gudang/lihat/'.$req->id_goods_out_warehouse);
    }

    public function destroy($id)
    {
      GoodsOutWarehouseDetail::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return back();
    }

    public function getGoodsReturn(Request $req)
    {
      $search = trim($req->q);
      $id = trim($req->id);

      $gowd = GoodsOutWarehouseDetail::getGoodsReturn($id, $search);

      return response()->json($gowd);
    }

    public function getOneGoods($id_goods, $id_gow)
    {
      $gowd = GoodsOutWarehouseDetail::getOneGoods($id_goods, $id_gow);

      return $gowd;
    }
}
