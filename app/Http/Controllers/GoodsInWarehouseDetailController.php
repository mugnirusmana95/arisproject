<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsInWarehouse;
use App\GoodsInWarehouseDetail;
use App\Good;
use Session;

class GoodsInWarehouseDetailController extends Controller
{
    public function create($id_goods_in_warehouse)
    {
      $data['giw'] = GoodsInWarehouse::getId($id_goods_in_warehouse);
      $data['giwd'] = GoodsInWarehouseDetail::getIdGoodsInWarehouse($id_goods_in_warehouse);
      $data['goods'] = Good::getAll();

      return view('goodsInWarehouse.detail.create',$data);
    }

    public function store(Request $req, $id_goods_in_warehouse)
    {
      if(count($req->goods)>0){
        $j = count($req->goods);
        for ($i=0; $i < $j; $i++) {
          GoodsInWarehouseDetail::insertOrEdit($req->qyt_box[$i], $req->qyt_pcs[$i], $req->decsription2[$i], $req->goods[$i], $id_goods_in_warehouse);
        }
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/gudang/lihat/'.$id_goods_in_warehouse);
    }

    public function edit($id)
    {
      $data['giwd']  = GoodsInWarehouseDetail::getId($id);
      $data['giw']   = GoodsInWarehouse::getId($data['giwd']->id_goods_in_warehouse);
      $data['goods'] = Good::getAllReady();

      return view('goodsInWarehouse.detail.edit',$data);
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

      GoodsInWarehouseDetail::edit($id, $req->qyt_box, $req->qyt_pcs, $req->description, $req->goods, $req->id_goods_in_warehouse);

      Session::flash('success','Data berhasil diupdate');

      return redirect('/barang_masuk/gudang/lihat/'.$req->id_goods_in_warehouse);
    }

    public function destroy($id)
    {
      GoodsInWarehouseDetail::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return back();
    }
}
