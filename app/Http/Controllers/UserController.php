<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class UserController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $data['user'] = User::getAllUnlessLogin($id);
    $data['no'] = 1;

    return view('user.index',$data);
  }

  public function create()
  {
    return view('user.create');
  }

  public function store(Request $req)
  {
    $this->validate($req,[
      'first_name' => 'required|max:20',
      'last_name' => 'nullable|max:20',
      'email' => 'required|max:50|email|unique:users',
      'status' => 'required'
    ],[
      'first_name.required' => 'Field wajib diisi',
      'first_name.max' => 'Maksimal 20 karakter',
      'last_name.required' => 'Field wajib diisi',
      'last_name.max' => 'Maksimal 20 karakter',
      'email.required' => 'Field wajib diisi',
      'email.max' => 'Maksimal 50 karakter',
      'email.email' => 'Email tidak valid',
      'email.unique' => 'Email telah digunakan',
      'status.required' => 'Field wajib dipilih'
    ]);

    $id = User::getNewId();

    User::insert($id, $req->first_name, $req->last_name, $req->email, $req->status);

    Session::flash('success','Data berhasil disimpan');

    return redirect('/master/user/lihat/'.$id);
  }

  public function open($id)
  {
    $data['user'] = User::getId($id);

    return view('user.detail',$data);
  }

  public function edit($id)
  {
    $data['user'] = User::getId($id);

    return view('user.edit',$data);
  }

  public function update(Request $req, $id)
  {
    $this->validate($req,[
      'status' => 'required'
    ],[
      'status.required' => 'Field wajib dipilih'
    ]);

    User::updateStatus($id, $req->status);

    Session::flash('success','Status berhasil diubah');

    return redirect('/master/user/lihat/'.$id);
  }

  public function resetPassword($id)
  {
    User::resetPassword($id);

    Session::flash('success','Password berhasil direset');

    return back();
  }

  public function destroy($id)
  {
    $user = User::getId($id);

    if ($user->picture != null || $user->picture != "") {
      unlink('images/profile/'.$user->id.'/'.$user->picture);
      rmdir('images/profile/'.$user->id);
    }

    User::destroy($id);

    Session::flash('success','Data berhasil dihapus');

    return redirect('/master/user');
  }

  public function test()
  {
    $digit1 = rand(0,9);
    $digit2 = rand(0,9);
    $digit3 = rand(0,9);
    $digit4 = rand(0,9);
    $digit = $digit1.$digit2.$digit3.$digit4;

    dd($digit1,$digit2,$digit3,$digit4,$digit);
  }
}
