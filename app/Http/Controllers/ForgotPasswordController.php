<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ForgotPassword;
use Crypt;
use Session;
use Mail;

class ForgotPasswordController extends Controller
{
    public function index()
    {
      return view('forgotPassword.index');
    }

    public function cekEmail(Request $req)
    {
      $this->validate($req,[
        'email'           => 'required|email'
      ],[
        'email.required'  => 'Field wadjib diisi',
        'email.email'     => 'Email tidak valid',
      ]);

      $data['user'] = User::getEmail($req->email);

      if (count($data['user'])>0) {
        $min = pow(10, 3);
        $max = pow(10, 4)-1;
        $code = rand($min, $max);
        $encrypt_code = Crypt::encrypt($code);
        ForgotPassword::insert($req->email, $code);

        $data['code'] = $code;
        $data['email'] = $req->email;

        Mail::send('forgotPassword.mail_message',$data, function($message) use ($data) {
          $message->to($data['email'])->subject('Kode Verifikasi');
          $message->from('mugnirusmana95@gmail.com','Support');
        });

        return redirect('lupa_password/verifikasi_kode/'.$req->email.'/'.$encrypt_code);
      } else {
        Session::flash('warning','Email tidak ditemukan');
        return back();
      }
    }

    public function verifyCode($email, $code)
    {
      $data['email'] = $email;

      return view('forgotPassword.verify_code', $data);
    }

    public function storeVerifyCode(Request $req, $email)
    {
      $this->validate($req,[
        'code' => 'required|numeric',
      ],[
        'code.required' => 'Field wajib diisi',
        'code.numeric' => 'Karakter tidak valid',
      ]);

      $fp = ForgotPassword::getCode($email);
      $code = (int)$req->code;

      if (count($fp)>0) {
        if ($fp->code == $code) {
          $code = Crypt::encrypt($fp->code);
          return redirect('/lupa_password/ubah_password/'.$email.'/'.$code);
        } else {
          Session::flash('warning','Kode salah');
          return back();
        }
      } else {
        Session::flash('warning','Kode salah');
        return back();
      }
    }

    public function resendCode($email)
    {
      $data['email'] = $email;
      $min = pow(10, 3);
      $max = pow(10, 4)-1;
      $code = rand($min, $max);
      $encrypt_code = Crypt::encrypt($code);

      ForgotPassword::insert($email, $code);

      $data['code'] = $code;
      $data['email'] = $email;

      Mail::send('forgotPassword.mail_message',$data, function($message) use ($data) {
        $message->to($data['email'])->subject('Kode Verifikasi');
        $message->from('mugnirusmana95@gmail.com','Support');
      });

      Session::flash('success','Kode berhasil dikirim');

      return redirect('lupa_password/verifikasi_kode/'.$email.'/'.$encrypt_code);
    }

    public function editPassword($email, $code)
    {
      $data['email'] = $email;

      return view('forgotPassword.edit_password',$data);
    }

    public function updatePassword(Request $req, $email)
    {
      $this->validate($req,[
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
      ],[
        'password.required' => 'Field wajib diisi',
        'password.confirmed' => 'Password tidak sama',
        'password_confirmation.required' => 'Field wajib diisi',
      ]);

      User::editPasswordByEmail($email, $req->password);

      Session::flash('success','Password berhasil diubah');

      return redirect('/login');
    }
}
