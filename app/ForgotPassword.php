<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $table = 'forgot_passwords';

    public static function insert($email, $code)
    {
      $fp_email = ForgotPassword::where('email',$email)->first();
      if (count($fp_email)>0) {
        $fp_email->delete();
      }
      $fp = new ForgotPassword;
      $fp->email = $email;
      $fp->code = $code;
      $fp->save();
    }

    public static function getCode($email)
    {
      $fp = ForgotPassword::where('email',$email)->orderBy('created_at','DESC')->first();

      return $fp;
    }
}
