<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Session;

class SupplierController extends Controller
{
    public function index()
    {
      $data['supplier'] = Supplier::getAll();
      $data['no'] = 1;

      return view('supplier.index',$data);
    }

    public function create()
    {
      return view('supplier.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'name'            => 'required|max:100|regex:/^[a-zA-Z0-9. ]+$/',
        'phone'           => 'nullable|max:13|regex:/^[0-9+]+$/',
        'telp'            => 'nullable|max:13|regex:/^[0-9+()]+$/',
        'fax'             => 'nullable|max:13|regex:/^[0-9+()]+$/',
        'email'           => 'nullable|email|max:50',
        'address'         => 'required|max:255|regex:/^[a-zA-Z0-9. ]+$/',
      ],[
        'name.required'   => 'Field wajib diisi',
        'name.max'        => 'Maksimal 100 karakter',
        'name.regex'      => 'Karakter tidak diijinkan (hanya : a-z, A-Z, 0-9, spasi)',
        'phone.max'       => 'Maksimal 13 karakter',
        'phone.regex'     => 'Karakter tidak diijinkan (hanya : 0-9, +)',
        'telp.max'        => 'Maksimal 13 karakter',
        'telp.regex'      => 'Karakter tidak diijinkan (hanya : 0-9, +, (, ))',
        'fax.max'         => 'Maksimal 13 karakter',
        'fax.regex'       => 'Karakter tidak diijinkan (hanya : 0-9, +, (, ))',
        'email.email'     => 'Email tidak valid',
        'email.max'       => 'Maksimal 50 karakter',
        'address.required'=> 'Field wajib diisi',
        'address.max'     => 'Maksimal 255 karakter',
        'address.regex'   => 'Karakter tidak diijinkan',
      ]);

      $id = Supplier::getNewId();

      Supplier::insert($id, $req->name, $req->phone, $req->telp, $req->fax, $req->email, $req->address);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/master/supplier');
    }

    public function open($id)
    {
      $data['supplier'] = Supplier::getId($id);

      return view('supplier.detail',$data);
    }

    public function edit($id)
    {
      $data['supplier'] = Supplier::getId($id);

      return view('supplier.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $supplier = Supplier::edit($id, $req->name, $req->phone, $req->telp, $req->fax, $req->email, $req->address);

      Session::flash('success','Data berhasil diubah');

      return redirect('/master/supplier');
    }

    public function destroy($id)
    {
      Supplier::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return back();
    }
}
