<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReturnWarehouse extends Model
{
    protected $table = "return_warehouses";
    protected $primaryKey = "id";
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('return_warehouses')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'REW'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $rw = ReturnWarehouse::orderBy('created_at','DESC')->get();

      return $rw;
    }

    public static function getId($id)
    {
      $rw = ReturnWarehouse::find($id);

      return $rw;
    }

    public static function getIdGoodsOutWarehouse($id_gow)
    {
      $rw = ReturnWarehouse::where('id_goods_out_warehouse',$id_gow)->first();

      return $rw;
    }

    public static function insert($id, $date, $description, $id_gow)
    {
      $rw = new ReturnWarehouse;
      $rw->id = $id;
      $rw->date = $date;
      $rw->description = $description;
      $rw->id_goods_out_warehouse = $id_gow;
      $rw->save();

      return $rw;
    }

    public static function editDescription($desc, $id_rew)
    {
      $rw = ReturnWarehouse::find($id_rew);
      $rw->description = $desc;
      $rw->save();

      return $rw;
    }

    public static function destroys($id)
    {
      $rw = ReturnWarehouse::find($id);
      $rw->delete();

      return $rw;
    }

    public function goodsOutWarehouse()
    {
      return $this->belongsTo('App\GoodsOutWarehouse','id_goods_out_warehouse');
    }

    public function goodsReturnWarehouseDetail()
    {
      return $this->hasMany('App\ReturnWarehouseDetail');
    }
}
