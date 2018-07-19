<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsInWarehouse;
use App\GoodsInWarehouseDetail;
use App\Warehouse;
use App\Good;
use Session;

class GoodsInWarehouseController extends Controller
{
    public function index()
    {
      $data['giw'] = GoodsInWarehouse::getAll();
      $data['no'] = 1;

      return view('goodsInWarehouse.index',$data);
    }

    public function create()
    {
      $data['warehouse'] = Warehouse::getAll();
      $data['goods'] = Good::getAllReady();

      return view('goodsInWarehouse.create',$data);
    }

    public function store(Request $req)
    {
      $id = GoodsInWarehouse::getNewId();

      $giw = GoodsInWarehouse::insert($id, $req->warehouse, $req->description);

      if(count($req->goods)>0){
        $j = count($req->goods);
        for ($i=0; $i < $j; $i++) {
          GoodsInWarehouseDetail::insert($id, $req->goods[$i], $req->qyt_box[$i], $req->qyt_pcs[$i], $req->decsription[$i]);
        }
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/gudang/lihat/'.$id);
    }

    public function open($id)
    {
      $data['giw'] = GoodsInWarehouse::getId($id);
      $data['giwd'] = GoodsInWarehouseDetail::getIdGoodsInWarehouse($id);

      return view('goodsInWarehouse.detail',$data);
    }

    public function edit($id)
    {
      $data['warehouse'] = Warehouse::getAll();
      $data['giw'] = GoodsInWarehouse::getId($id);

      return view('goodsInWarehouse.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'warehouse'          => 'required',
        'description'        => 'nullable|max:255',
      ],[
        'warehouse.required' => 'Field wajib dipilih',
        'description.max' => 'Maksimal 255 karekter',
      ]);

      GoodsInWarehouse::edit($id, $req->warehouse, $req->description);

      Session::flash('success','Data berhasil diubah');

      return redirect('/barang_masuk/gudang/lihat/'.$id);
    }

    public function destroy($id)
    {
      GoodsInWarehouse::destroy($id);

      $giwd = GoodsInWarehouseDetail::getIdGoodsInWarehouse($id);
      if (count($giwd)>0) {
        foreach ($giwd as $item) {
          GoodsInWarehouseDetail::destroyGoodInWarehouse($id);
        }
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_masuk/gudang');
    }
}
