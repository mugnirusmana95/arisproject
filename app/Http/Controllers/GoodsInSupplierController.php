<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsInSupplier;
use App\GoodsInSupplierDetail;
use App\Supplier;
use App\Good;
use Session;

class GoodsInSupplierController extends Controller
{
    public function index()
    {
      $data['gis'] = GoodsInSupplier::getAll();

      return view('goodsInSupplier.index',$data);
    }

    public function create()
    {
      $data['supplier'] = Supplier::getAll();
      $data['goods'] = Good::getAllReady();

      return view('goodsInSupplier.create',$data);
    }

    public function store(Request $req)
    {
      $id = GoodsInSupplier::getNewId();

      $gis = GoodsInSupplier::insert($id, $req->supplier);

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
      $data['supplier'] = Supplier::getAll();
      $data['gis'] = GoodsInSupplier::getId($id);

      return view('goodsInSupplier.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'supplier'          => 'required',
      ],[
        'supplier.required' => 'Field wajib dipilih',
      ]);

      $gis = GoodsInSupplier::edit($id, $req->supplier);

      Session::flash('success','Data berhasil diubah');

      return redirect('/barang_masuk/supplier/lihat/'.$id);
    }

    public function open($id)
    {
      $data['gis'] = GoodsInSupplier::getId($id);
      $data['gisd'] = GoodsInSupplierDetail::getIdGoodsInSupplier($id);

      return view('goodsInSupplier.detail',$data);
    }

    public function destroy($id)
    {
      $gis = GoodsInSupplier::destroy($id);

      $gisd = GoodsInSupplierDetail::getIdGoodsInSupplier($id);
      if (count($gisd)>0) {
        foreach ($gisd as $item) {
          GoodsInSupplierDetail::destroyGoodInSupplier($id);
        }
      }

      Session::flash('seccess','Data berhasil dihapus');

      return redirect('/barang_masuk/supplier');
    }
}
