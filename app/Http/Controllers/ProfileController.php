<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
      $id = Auth::user()->id;
      $data['user'] = User::getId($id);

      return view('profile.index',$data);
    }

    public function editData()
    {
      $id = Auth::user()->id;
      $data['user'] = User::getId($id);

      return view('profile.edit_data',$data);
    }

    public function updateData(Request $req)
    {
      $id = Auth::user()->id;

      $this->validate($req,[
        'first_name' => 'required|max:20',
        'last_name' => 'nullable|max:20',
        'email' => 'required|max:50|email|unique:users,email,'.$id,
        'phone' => 'nullable|min:9|max:15|unique:users,phone,'.$id,
        'place' => 'nullable|max:20',
        'adress' => 'nullable|max:100',
      ],[
        'first_name.required' => 'Field wajib diisi',
        'first_name.max' => 'Maksimal 20 karakter',
        'last_name.max' => 'Maksimal 20 karakter',
        'email.required' => 'Field wajib diisi',
        'email.max' => 'Maksimal 50 karakter',
        'email.email' => 'Email tidak valid',
        'email.unique' => 'Email sudah digunakan',
        'phone.min' => 'Minimal 9 karakter',
        'phone.max' => 'Maksimal 15 karakter',
        'place.max' => 'Maksimal 20 karakter',
        'address.max' => 'Maksimal 100 karakter',
      ]);

      User::edit($id, $req->first_name, $req->last_name, $req->gender, $req->email, $req->phone, $req->place, $req->date, $req->address);

      Session::flash('success','Data berhasil diubah');

      return redirect('/profile');
    }

    public function editPicture()
    {
      return view('profile.edit_picture');
    }

    public function updatePicture(Request $req)
    {
      $this->validate($req,[
        'picture' => 'required|mimes:jpg,jpeg,png'
      ],[
        'picture.required' => 'Field wajib diisi.',
        'picture.mimes' => 'Format foto tidak valid.',
      ]);

      $id = Auth::user()->id;

      $name = $req->input('name');
      $file = $req->file('picture');
      $ext = $file->getClientOriginalExtension();
      $picture = $id.".".$ext;
      $file->move('images/profile/'.$id, $picture);

      User::editPicture($id, $picture);

      Session::flash('success','Foto profile berhasil diubah');

      return redirect('/profile');
    }

    public function editPassword()
    {
      return view('profile.edit_password');
    }

    public function updatePassword(Request $req)
    {
      $this->validate($req,[
        'old_password' => 'required',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required'
      ],[
        'old_password.required' => 'Field wajib diisi',
        'password.required' => 'Field wajib diisi',
        'password.confirmed' => 'Password baru tidak sama',
        'password_confirmation.required' => 'Field wajib diisi',
      ]);

      $id= Auth::user()->id;
      $password = Auth::user()->password;
      $check    = Hash::check($req->old_password, $password);

      if ($check == true) {
        User::editPassword($id, $req->password);

        Session::flash('success','Password berhasil diubah');
        return redirect('/profile');

      } else {
        Session::flash('warning','Password lama tidak sesuai');
        return back();
      }
    }
}
