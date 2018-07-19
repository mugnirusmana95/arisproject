<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsInSupplier;
use App\GoodsInSupplierDetail;
use App\Good;
use Session;

class GoodsInSupplierDetailController extends Controller
{
    public function create($id_goods_in_supplier)
    {
      $data['gis'] = GoodsInSupplier::getId($id_goods_in_supplier);
      $data['gisd'] = GoodsInSupplierDetail::getIdGoodsInSupplier($id_goods_in_supplier);
      $data['goods'] = Good::getAll();

      return view('goodsInSupplier.detail.create',$data);
    }

    public function store(Request $req, $id)
    {
      if(count($req->goods)>0){
        $j = count($req->goods);
        for ($i=0; $i < $j; $i++) {
          GoodsInSupplierDetail::insert($id, $req->goods[$i], $req->qyt_box[$i], $req->qyt_pcs[$i], $req->decsription[$i]);
        }
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/supplier/lihat/'.$id);
    }

    public function edit($id)
    {
      $data['gisd'] = GoodsInSupplierDetail::getId($id);
      $data['gis']  = GoodsInSupplier::getId($data['gisd']->id_goods_in_supplier);
      $data['goods'] = Good::getAllReady();

      return view('goodsInSupplier.detail.edit',$data);
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

      $gisd = GoodsInSupplierDetail::getId($id);
      $gis = GoodsInSupplier::getId($gisd->id_goods_in_supplier);

      GoodsInSupplierDetail::edit($id, $req->qyt_box, $req->qyt_pcs, $req->description, $req->goods, $gis->id);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/supplier/lihat/'.$gis->id);
    }


    public function destroy($id)
    {
      GoodsInSupplierDetail::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return back();
    }
}
