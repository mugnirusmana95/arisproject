<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReturnWarehouse;
use App\ReturnWarehouseDetail;
use Session;

class GoodsInReturnWarehouseDetailController extends Controller
{
    public function create($id)
    {
      $data['rw'] = ReturnWarehouse::getId($id);
      $data['rwd'] = ReturnWarehouseDetail::getIdReturnWarehouse($id);
      $data['no'] = 1;

      return view('returnWarehouse.detail.create',$data);
    }

    public function store(Request $req, $id)
    {
      $this->validate($req,[
        'goods' => 'required'
      ],[
        'goods.required' => 'Field wajib diisi'
      ]);

      foreach ($req->goods as $key) {
        ReturnWarehouseDetail::insertId($key, $id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/retur/gudang/detail/tambah/stok/'.$id);
    }

    public function addStock($id)
    {
      $data['rw'] = ReturnWarehouse::getId($id);
      $data['rwd'] = ReturnWarehouseDetail::getIdReturnWarehouse($id);
      $data['no'] = 1;

      return view('returnWarehouse.detail.add_stock',$data);
    }

    public function storeStock(Request $req, $id)
    {
      foreach ($req->goods as $item => $value) {
        $id_goods = $value;
        $qyt_box = $req->qyt_box[$item];
        $qyt_pcs = $req->qyt_pcs[$item];
        $bad_box = $req->bad_box[$item];
        $bad_pcs = $req->bad_pcs[$item];
        $desc = $req->description2[$item];
        ReturnWarehouseDetail::edit($id_goods, $qyt_box, $qyt_pcs, $bad_box, $bad_pcs, $desc, $id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/retur/gudang/lihat/'.$id);
    }

    public function edit($id)
    {
      $data['rwd'] = ReturnWarehouseDetail::getId($id);
      $data['rw'] = ReturnWarehouse::getId($data['rwd']->id_return_warehouse);

      return view('returnWarehouse.detail.edit',$data);
    }

    public function update(Request $req, $id)
    {
      ReturnWarehouseDetail::edit($req->goods, $req->qyt_box, $req->qyt_pcs, $req->bad_box, $req->bad_pcs, $req->description, $req->id);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/retur/gudang/lihat/'.$req->id);
    }

    public function destroy($id)
    {
      $rwd = ReturnWarehouseDetail::getId($id);

      ReturnWarehouseDetail::destroys($rwd->id_goods, $rwd->id_return_warehouse);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/retur/gudang/lihat/'.$rwd->id_return_warehouse);

    }

    public function getOneGoods($id_goods, $id_rew)
    {
      $rwd = ReturnWarehouseDetail::getOneGoods($id_goods, $id_rew);

      return $rwd;
    }
}
