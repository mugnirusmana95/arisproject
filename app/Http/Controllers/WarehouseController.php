<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use Session;

class WarehouseController extends Controller
{
    public function index()
    {
      $data['warehouse'] = Warehouse::getAll();
      $data['no'] = 1;

      return view('warehouse.index',$data);
    }

    public function create()
    {
      return view('warehouse.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'name'            => 'required|max:100|regex:/^[a-zA-Z0-9. ]+$/',
        'address'         => 'nullable|max:255|regex:/^[a-zA-Z0-9. ]+$/',
      ],[
        'name.required'   => 'Field wajib diisi',
        'name.max'        => 'Maksimal 100 karekter',
        'name.regex'      => 'Karakter tidak dijinkah (hanya : a-z, A-Z, 0-9, spasi dan titik)',
        'address.max'     => 'Maksimal 255 karekter',
        'address.regex'   => 'Karakter tidak dijinkah (hanya : a-z, A-Z, 0-9, spasi dan titik)',
      ]);
      $id = Warehouse::getNewId();

      Warehouse::insert($id, $req->name, $req->address);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/master/gudang');
    }

    public function edit($id)
    {
      $data['warehouse'] = Warehouse::getId($id);

      return view('warehouse.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'name'            => 'required|max:100|regex:/^[a-zA-Z0-9. ]+$/',
        'address'         => 'nullable|max:255|regex:/^[a-zA-Z0-9. ]+$/',
      ],[
        'name.required'   => 'Field wajib diisi',
        'name.max'        => 'Maksimal 100 karekter',
        'name.regex'      => 'Karakter tidak dijinkah (hanya : a-z, A-Z, 0-9, spasi dan titik)',
        'address.max'     => 'Maksimal 255 karekter',
        'address.regex'   => 'Karakter tidak dijinkah (hanya : a-z, A-Z, 0-9, spasi dan titik)',
      ]);

      Warehouse::edit($id, $req->name, $req->address);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/master/gudang');
    }

    public function destroy($id)
    {
      Warehouse::destroy($id);

      return redirect('/master/gudang');
    }

    public function getAll(Request $req)
    {
      $term = trim($req->q);

      $warehouses = Warehouse::getAllAjax($term);

      return response()->json($warehouses);
    }
}
