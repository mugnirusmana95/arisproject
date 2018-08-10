<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReturnWarehouse;
use App\ReturnWarehouseDetail;
use App\GoodsOutWarehouse;
use Session;

class GoodsInReturnWarehouseController extends Controller
{
    public function index()
    {
      $data['rw'] = ReturnWarehouse::getAll();
      $data['no'] = 1;

      return view('returnWarehouse.index',$data);
    }

    public function create()
    {
      return view('returnWarehouse.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'gow' => 'required',
        'date' => 'required',
        'goods' => 'required',
      ],[
        'gow.required' => 'Field wajib diisi',
        'date.required' => 'Field wajib diisi',
        'goods.required' => 'Field wajib diisi'
      ]);

      $id = ReturnWarehouse::getNewId();

      ReturnWarehouse::insert($id, $req->date, $req->description, $req->gow);

      foreach ($req->goods as $key) {
        ReturnWarehouseDetail::insertId($key, $id, $req->gow);
      }

      Session::flash('success','Data berhasil disimpan');

      return back();
    }
}
