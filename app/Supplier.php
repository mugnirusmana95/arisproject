<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Supplier extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('suppliers')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 8, 4);
      $nourut++;
      $id = 'S'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $sup = Supplier::orderBy('name','ASC')->get();

      return $sup;
    }

    public static function getId($id)
    {
      $sup = Supplier::find($id);

      return $sup;
    }

    public static function insert($id, $name, $phone, $telp, $fax, $email, $address)
    {
      $sup = new Supplier;
      $sup->id = $id;
      $sup->name = $name;
      $sup->phone = $phone;
      $sup->telp = $telp;
      $sup->fax = $fax;
      $sup->email = $email;
      $sup->address = $address;
      $sup->save();
    }

    public static function edit($id, $name, $phone, $telp, $fax, $email, $address)
    {
      $sup = Supplier::find($id);
      $sup->name = $name;
      $sup->phone = $phone;
      $sup->telp = $telp;
      $sup->fax = $fax;
      $sup->email = $email;
      $sup->address = $address;
      $sup->save();
    }

    public static function destroy($id)
    {
      $sup = Supplier::find($id);
      $sup->delete();
    }

    public function goodsInSupplier()
    {
      return $this->hasMany('App\GoodsInSupplier');
    }
}
