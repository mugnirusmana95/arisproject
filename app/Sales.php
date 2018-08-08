<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    public $incrementing = false;

    static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('sales')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 8, 4);
      $nourut++;
      $id = 'S'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $sales = Sales::orderBy('name','ASC')->get();

      return $sales;
    }

    public static function getId($id)
    {
      $sales = Sales::find($id);

      return $sales;
    }

    public static function insert($id, $name, $gender, $phone, $email, $address)
    {
      $sales = new Sales;
      $sales->id = $id;
      $sales->name = $name;
      $sales->gender = $gender;
      $sales->phone = $phone;
      $sales->email = $email;
      $sales->address = $address;
      $sales->save();

      return $sales;
    }

    public static function edit($id, $name, $gender, $phone, $email, $address)
    {
      $sales = Sales::find($id);
      $sales->name = $name;
      $sales->gender = $gender;
      $sales->phone = $phone;
      $sales->email = $email;
      $sales->address = $address;
      $sales->save();

      return $sales;
    }

    public static function destroy($id)
    {
      $sales = Sales::find($id);
      $sales->delete();

      return $sales;
    }

    public static function getReady($search)
    {
      $sales = DB::select(DB::raw("SELECT id, name as text FROM sales WHERE name LIKE '%$search%' Order By name ASC LIMIT 0,10"));

      return $sales;
    }
}
