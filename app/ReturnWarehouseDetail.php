<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GoodsOutWarehouseDetail;

class ReturnWarehouseDetail extends Model
{
    protected $table = "return_warehouses_details";

    public function getId($id)
    {
      $rwd = ReturnWarehouseDetail::find($id);

      return $rwd;
    }

    public function getIdReturnWarehouse($id_return_warehouse)
    {
      $rwd = ReturnWarehouseDetail::where('id_return_warehouse',$id_return_warehouse)->get();

      return $rwd;
    }

    public static function insertId($id_goods, $id_return_warehouse, $id_goods_out_warehouse)
    {
      $gowd = GoodsOutWarehouseDetail::where('id_goods',$id_goods)->where('id_goods_out_warehouse',$id_goods_out_warehouse)->first();

      $rwd = new ReturnWarehouseDetail;
      $rwd->qyt_box_out = $gowd->qyt_box;
      $rwd->qyt_pcs_out = $gowd->qyt_pcs;
      $rwd->id_goods = $id_goods;
      $rwd->id_return_warehouse = $id_return_warehouse;
      $rwd->save();

      return $rwd;
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }

    public function returnWarehouse()
    {
      return $this->belongsTo('App\ReturnWarehouse','id_return_warehouse');
    }
}
