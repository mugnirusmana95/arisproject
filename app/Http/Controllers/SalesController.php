<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use Session;

class SalesController extends Controller
{
    public function index()
    {
      $data['sales'] = Sales::getAll();
      $data['no'] = 1;

      return view('sales.index',$data);
    }

    public function create()
    {
      return view('sales.create');
    }

    public function store(Request $req)
    {
      $this->validate($req,[
        'name' => 'required|max:50|regex:/^[a-zA-Z ]+$/',
        'gender' => 'required',
        'phone' => 'nullable|min:9|max:13|regex:/^[0-9]+$/',
        'email' => 'nullable|max:60|email|unique:sales|regex:/^[a-zA-Z0-9_@. ]+$/',
        'address' => 'nullable|max:100',
        'image' => 'nullable|mimes:jpeg,jpg,png',
      ],[
        'name.required' => 'Field wajib diisi',
        'name.max' => 'Maksimal 50 karakter',
        'name.regex' => 'Karakter tidak dijinkan (hanya : a-z, A-Z, spasi)',
        'gender.required' => 'Field wajib dipilih',
        'phone.min' => 'Minimal 9 karakter',
        'phone.max' => 'Minimal 13 karakter',
        'phone.regex' => 'Karakter tidak dijinkan (hanya : 0-9)',
        'email.max' => 'Maksimal 60 karakter',
        'email.email' => 'Email tidak valid',
        'email.unique' => 'Email sudah digunakan',
        'email.regex' => 'Karakter tidak diijinkan (hanya 0-9, a-z, A-Z, underscore(_), titik(.), at(@))',
        'address.max' => 'Maksimal 100 karakter',
        'image.max' => 'File bukan tipe .jpeg, .jpe, atau .png'
      ]);

      $id = Sales::getNewId();

      if ($req->image != null || $req->image != "") {
        $name = $req->input('name');
        $file = $req->file('image');
        $ext = $file->getClientOriginalExtension();
        $image = $id.".".$ext;
        $file->move('images/sales/'.$id, $image);
      } else {
        $image = "";
      }

      Sales::insert($id, $req->name, $req->gender, $req->phone, $req->email, $req->address, $image);

      Session::flash('success','Data berhasil disimpan');

      return redirect('/master/sales/lihat/'.$id);
    }

    public function open($id)
    {
      $data['sales'] = Sales::getId($id);

      return view('sales.detail',$data);
    }

    public function edit($id)
    {
      $data['sales'] = Sales::getId($id);

      return view('sales.edit',$data);
    }

    public function update(Request $req, $id)
    {
      $this->validate($req,[
        'name' => 'required|max:50|regex:/^[a-zA-Z ]+$/',
        'gender' => 'required',
        'phone' => 'nullable|min:9|max:13|regex:/^[0-9]+$/',
        'email' => 'nullable|max:60|email|regex:/^[a-zA-Z0-9_@. ]+$/|unique:sales,email,'.$id,
        'address' => 'nullable|max:100',
        'image' => 'nullable|mimes:jpeg,jpg,png',
      ],[
        'name.required' => 'Field wajib diisi',
        'name.max' => 'Maksimal 50 karakter',
        'name.regex' => 'Karakter tidak dijinkan (hanya : a-z, A-Z, spasi)',
        'gender.required' => 'Field wajib dipilih',
        'phone.min' => 'Minimal 9 karakter',
        'phone.max' => 'Minimal 13 karakter',
        'phone.regex' => 'Karakter tidak dijinkan (hanya : 0-9)',
        'email.max' => 'Maksimal 60 karakter',
        'email.email' => 'Email tidak valid',
        'email.unique' => 'Email sudah digunakan',
        'email.regex' => 'Karakter tidak diijinkan (hanya 0-9, a-z, A-Z, underscore(_), titik(.), at(@))',
        'address.max' => 'Maksimal 100 karakter',
        'image.max' => 'File bukan tipe .jpeg, .jpe, atau .png'
      ]);

      if ($req->image != null || $req->image != "") {
        $name = $req->input('name');
        $file = $req->file('image');
        $ext = $file->getClientOriginalExtension();
        $image = $id.".".$ext;
        $file->move('images/sales/'.$id, $image);
      } else {
        $image = "";
      }

      Sales::edit($id, $req->name, $req->gender, $req->phone, $req->email, $req->address, $image);

      Session::flash('success','Data berhasil diubah');

      return redirect('/master/sales/lihat/'.$id);
    }

    public function destroy($id)
    {
      $sales = Sales::getId($id);

      if ($sales->image != null || $sales->image != "") {
        unlink('images/sales/'.$sales->id.'/'.$sales->image);
        rmdir('images/sales/'.$sales->id);
      }

      Sales::destroy($id);

      Session::flash('success','Data berhasil dihapus');

      return redirect('/master/sales');
    }

    public function getAll(Request $req)
    {
      $term = trim($req->q);

      $sales = Sales::getReady($term);

      return response()->json($sales);
    }
}
