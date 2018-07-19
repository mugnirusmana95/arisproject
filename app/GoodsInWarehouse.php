<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoodsInWarehouse extends Model
{
    public $table = "goods_in_warehouses";
    protected $primaryKey = "id";
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('goods_in_warehouses')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'GIW'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $giw = GoodsInWarehouse::orderBy('created_at')->get();

      return $giw;
    }

    public static function getId($id)
    {
      $giw = GoodsInWarehouse::find($id);

      return $giw;
    }

    public static function insert($id, $id_warehouse, $description)
    {
      $giw = new GoodsInWarehouse;
      $giw->id = $id;
      $giw->id_warehouse = $id_warehouse;
      $giw->description = $description;
      $giw->save();

      return $giw;
    }

    public static function edit($id, $id_warehouse, $description)
    {
      $giw = GoodsInWarehouse::find($id);
      $giw->id_warehouse = $id_warehouse;
      $giw->description = $description;
      $giw->save();

      return $giw;
    }

    public static function destroy($id)
    {
      $giw = GoodsInWarehouse::find($id);
      $giw->delete();

      return $giw;
    }

    public function warehouse()
    {
      return $this->belongsTo('App\Warehouse','id_warehouse');
    }

    public function goodsInWarehouseDetail()
    {
      return $this->hasMany('App\GoodsInWarehouseDetail');
    }
}
