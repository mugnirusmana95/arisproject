<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsOutWarehouse;
use App\GoodsOutWarehouseDetail;
use App\Warehouse;
use App\Good;
use Session;

class GoodsOutWarehouseController extends Controller
{
    public function index()
    {
       $data['gow'] = GoodsOutWarehouse::getAll();
       $data['warehouse'] = Warehouse::getAll();
       $data['goods'] = Good::getAllReady();

       return view('goodsOutWarehouse.index',$data);
    }

    public function create()
    {
      return view('goodsOutWarehouse.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'warehouse' => 'required',
        'goods' => 'required',
        'description' => 'nullable|min:5|max:100',
      ],[
        'warehouse.required' => 'Field wajib dipilih',
        'goods.required' => 'Field wajib dipilih',
        'description.min' => 'Minimal 5 karakter',
        'description.max' => 'Maksimal 100 karakter'
      ]);

      $id = GoodsOutWarehouse::getNewId();

      $giw = GoodsOutWarehouse::insert($id, $req->warehouse, $req->description);

      foreach ($req->goods as $item => $value) {
        GoodsOutWarehouseDetail::insertId($value, $id);
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/gudang/tambah/stok/'.$id);
    }

    public function addStock($id)
    {
      $data['gow'] = GoodsOutWarehouse::find($id);
      $data['gowd'] = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($id);
      $data['no'] = 1;

      return view('goodsOutWarehouse.add_stock',$data);
    }

    public function storeStock(Request $req)
    {
      $gowd = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($req->id);

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

    public function open($id)
    {
      $data['gow'] = GoodsOutWarehouse::getId($id);
      $data['gowd'] = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($id);

      return view('goodsOutWarehouse.detail',$data);
    }

    public function edit($id)
    {
      $data['warehouse'] = Warehouse::getAll();
      $data['gow'] = GoodsOutWarehouse::getId($id);

      return view('goodsOutWarehouse.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'warehouse'          => 'required',
        'description'        => 'nullable|max:255',
      ],[
        'warehouse.required' => 'Field wajib dipilih',
        'description.max'    => 'Maksimal 255 karekter',
      ]);

      GoodsOutWarehouse::edit($id, $req->warehouse, $req->description);

      Session::flash('success','Data berhasil diubah');

      return redirect('/barang_keluar/gudang/lihat/'.$id);
    }

    public function destroy($id)
    {
      GoodsOutWarehouse::destroy($id);

      $gowd = GoodsOutWarehouseDetail::getIdGoodsOutWarehouse($id);
      if (count($gowd)>0) {
        foreach ($gowd as $item) {
          GoodsOutWarehouseDetail::destroyGoodOutWarehouse($id);
        }
      }

      Session::flash('success','Data berhasil disimpan');

      return redirect('/barang_keluar/gudang');
    }

    public function getAllReturn(Request $req)
    {
      $search = trim($req->q);

      $gow = GoodsOutWarehouse::getAllReturn($search);

      return response()->json($gow);
    }

    public function getId($id)
    {
      $gow = GoodsOutWarehouse::getId($id);

      return $gow;
    }
}
