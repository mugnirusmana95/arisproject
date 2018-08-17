<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('users')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'USR'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAllUnlessLogin($id)
    {
      $user = User::where('id','!=',$id)->orderBy('created_at','DESC')->get();

      return $user;
    }

    public static function getAll()
    {
      $user = User::orderBy('created_at','DESC')->get();

      return $user;
    }

    public static function getId($id)
    {
      $user = User::find($id);

      return $user;
    }

    public static function getEmail($email)
    {
      $user = User::select('email')->where('email',$email)->first();

      return $user;
    }

    public static function insert($id, $first_name, $last_name, $email, $status)
    {
      $user = new User;
      $user->id = $id;
      $user->first_name = $first_name;
      $user->last_name = $last_name;
      $user->email = $email;
      $user->password = bcrypt("bersamamandiri");
      $user->status = $status;
      $user->save();

      return $user;
    }

    public static function edit($id, $first_name, $last_name, $gender, $email, $phone, $place_ob, $date_ob, $address)
    {
      $user = User::find($id);
      $user->first_name = $first_name;
      $user->last_name = $last_name;
      $user->gender = $gender;
      $user->email = $email;
      $user->phone = $phone;
      $user->pob = $place_ob;
      $user->dob = $date_ob;
      $user->address = $address;
      $user->save();

      return $user;
    }

    public static function updateStatus($id, $status)
    {
      $user = User::find($id);
      $user->status = $status;
      $user->save();

      return $user;
    }

    public static function editPicture($id, $picture)
    {
      $user = User::find($id);
      $user->picture = $picture;
      $user->save();

      return $user;
    }

    public static function resetPassword($id)
    {
      $user = User::find($id);
      $user->password = bcrypt("bersamamandiri");
      $user->save();

      return $user;
    }

    public static function editPassword($id, $password)
    {
      $user = User::find($id);
      $user->password = bcrypt($password);
      $user->save();

      return $user;
    }

    public static function editPasswordByEmail($email, $password)
    {
      $user = User::where('email',$email)->first();
      $user->password = bcrypt($password);
      $user->save();

      return $user;
    }

    public static function destroy($id)
    {
      $user = User::find($id);
      $user->delete();

      return $user;
    }
}
