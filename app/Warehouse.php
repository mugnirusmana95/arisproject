<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('warehouses')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 8, 4);
      $nourut++;
      $id = 'W'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $warehouse = Warehouse::orderBy('created_at')->get();

      return $warehouse;
    }

    public static function getId($id)
    {
      $warehouse = Warehouse::find($id);

      return $warehouse;
    }

    public static function insert($id, $name, $address, $phone)
    {
      $warehouse          = new Warehouse;
      $warehouse->id      = $id;
      $warehouse->name    = $name;
      $warehouse->address = $address;
      $warehouse->phone = $phone;
      $warehouse->save();

      return $warehouse;
    }

    public static function edit($id, $name, $address, $phone)
    {
      $warehouse          = Warehouse::find($id);
      $warehouse->id      = $id;
      $warehouse->name    = $name;
      $warehouse->address = $address;
      $warehouse->phone = $phone;
      $warehouse->save();

      return $warehouse;
    }

    public static function destroy($id)
    {
      $warehouse = Warehouse::find($id);
      $warehouse->delete();

      return $warehouse;
    }

    public static function getAllAjax($search)
    {
      $warehouses = DB::select(DB::raw("SELECT id, name as text FROM warehouses WHERE name LIKE '%$search%' LIMIT 0,20"));

      return $warehouses;
    }
}
