<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;
use Session;

class GoodController extends Controller
{
    public function index()
    {
      $data['good'] = Good::getAll();
      $data['no'] = 1;

      return view('good.index',$data);
    }

    public function create()
    {
      return view('good.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'name'                  => 'required|max:100|regex:/^[a-zA-Z0-9 ]+$/',
        'bad_stock_box'         => 'nullable|max:4|regex:/^[0-9]+$/',
        'bad_stock_pcs'         => 'nullable|max:4|regex:/^[0-9]+$/',
        'qyt_box'               => 'nullable|max:4|regex:/^[0-9]+$/',
        'qyt_pcs'               => 'nullable|max:4|regex:/^[0-9]+$/',
        'pcs_per_box'           => 'required|max:4|regex:/^[0-9]+$/',
      ],[
        'name.required'         => 'Field wajib diisi',
        'name.max'              => 'Maksimal 100 karakter',
        'name.regex'            => 'Karakter tidak diijinkan (hanya : a-z, A-Z, 0-9, spasi)',
        'qyt_box.max'           => 'Maksimal 4 karekter',
        'qyt_box.regex'         => 'Karakter tidak diijinkan (hanya : 0-9)',
        'bad_stock_box.max'     => 'Maksimal 4 karekter',
        'bad_stock_box.regex'   => 'Karakter tidak diijinkan (hanya : 0-9)',
        'bad_stock_pcs.max'     => 'Maksimal 4 karekter',
        'bad_stock_pcs.regex'   => 'Karakter tidak diijinkan (hanya : 0-9)',
        'qyt_pcs.max'           => 'Maksimal 4 karekter',
        'qyt_pcs.regex'         => 'Karakter tidak diijinkan (hanya : 0-9)',
        'pcs_per_box.required'  => 'Field wajib diisi',
        'pcs_per_box.max'       => 'Maksimal 4 karekter',
        'pcs_per_box.regex'     => 'Karakter tidak diijinkan (hanya : 0-9)',
      ]);

      $id = Good::getNewId();
      Good::insert($id, $req->name, $req->qyt_box, $req->qyt_pcs, $req->pcs_per_box, $req->bad_stock_box, $req->bad_stock_pcs);

      Session::flash('success','Data telah disimpan');

      return redirect('/master/barang');
    }

    public function edit($id)
    {
      $data['good'] = Good::getId($id);

      return view('good.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'name'                  => 'required|max:100|regex:/^[a-zA-Z0-9 ]+$/',
        'bad_stock_box'         => 'nullable|max:4|regex:/^[0-9]+$/',
        'bad_stock_pcs'         => 'nullable|max:4|regex:/^[0-9]+$/',
        'qyt_box'               => 'nullable|max:4|regex:/^[0-9]+$/',
        'qyt_pcs'               => 'nullable|max:4|regex:/^[0-9]+$/',
        'pcs_per_box'           => 'required|max:4|regex:/^[0-9]+$/',
      ],[
        'name.required'         => 'Field wajib diisi',
        'name.max'              => 'Maksimal 100 karakter',
        'name.regex'            => 'Karakter tidak diijinkan (hanya : a-z, A-Z, 0-9, spasi)',
        'qyt_box.max'           => 'Maksimal 4 karekter',
        'qyt_box.regex'         => 'Karakter tidak diijinkan (hanya : 0-9)',
        'bad_stock_box.max'     => 'Maksimal 4 karekter',
        'bad_stock_box.regex'   => 'Karakter tidak diijinkan (hanya : 0-9)',
        'bad_stock_pcs.max'     => 'Maksimal 4 karekter',
        'bad_stock_pcs.regex'   => 'Karakter tidak diijinkan (hanya : 0-9)',
        'qyt_pcs.max'           => 'Maksimal 4 karekter',
        'qyt_pcs.regex'         => 'Karakter tidak diijinkan (hanya : 0-9)',
        'pcs_per_box.required'  => 'Field wajib diisi',
        'pcs_per_box.max'       => 'Maksimal 4 karekter',
        'pcs_per_box.regex'     => 'Karakter tidak diijinkan (hanya : 0-9)',
      ]);

      Session::flash('success','Data berhasil diubah');

      $good = Good::edit($id, $req->name, $req->qyt_box, $req->qyt_pcs, $req->pcs_per_box, $req->bad_stock_box, $req->bad_stock_pcs);

      return redirect('/master/barang');
    }

    public function destroy($id)
    {
      Good::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return back();
    }

    public function getAllNotInWarehouseOut(Request $req)
    {
      $id = trim($req->id);
      $term = trim($req->q);

      $goods = Good::getAllNotInWarehouseOut($id, $term);

      return response()->json($goods);
    }

    public function getAllNotInSalesOut(Request $req)
    {
      $id = trim($req->id);
      $term = trim($req->q);

      $goods = Good::getAllNotInSalesOut($id, $term);

      return response()->json($goods);
    }

    public function checkStock($id)
    {
      $goods = Good::getId($id);

      return $goods;
    }

    public function getReady(Request $req)
    {
      $term = trim($req->q);

      $goods = Good::getReady($term);

      return response()->json($goods);
    }
}
