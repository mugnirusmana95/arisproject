<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GoodsOutWarehouseDetail;
use App\Good;
use DB;

class ReturnWarehouseDetail extends Model
{
    protected $table = "return_warehouses_details";

    public static function getId($id)
    {
      $rwd = ReturnWarehouseDetail::find($id);

      return $rwd;
    }

    public static function getIdReturnWarehouse($id_return_warehouse)
    {
      $rwd = ReturnWarehouseDetail::where('id_return_warehouse',$id_return_warehouse)->get();

      return $rwd;
    }

    public static function getIdGoods($id_goods, $id_gow)
    {
      $rwd = DB::table('return_warehouses_details')
                  ->join('return_warehouses','return_warehouses_details.id_return_warehouse','=','return_warehouses.id')
                  ->where('return_warehouses_details.id_goods',$id_goods)
                  ->where('return_warehouses.id_goods_out_warehouse',$id_gow)
                  ->get();
      return $rwd;
    }

    public static function getOneGoods($id_goods, $id_rew)
    {
      $rwd = ReturnWarehouseDetail::where('id_goods',$id_goods)->where('id_return_warehouse',$id_rew)->first();

      return $rwd;
    }

    public static function getGoodsDate($id_goods, $date)
    {
      $rwd = ReturnWarehouseDetail::with('goods')->select(DB::raw("SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs"))->where('id_goods',$id_goods)->whereDate('created_at',$date)->groupBy('id_goods')->first();

      return $rwd;
    }

    public static function getGoodsDateBack($id_goods, $date)
    {
      $rwd = ReturnWarehouseDetail::with('goods')->select(DB::raw("SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs"))->where('id_goods',$id_goods)->whereDate('created_at','<=',$date)->groupBy('id_goods')->first();

      return $rwd;
    }

    public static function getGoodsYear($year)
    {
      $rwd = ReturnWarehouseDetail::select(DB::raw("SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs"))->whereDate('created_at','LIKE','%'.$year.'%')->first();

      return $rwd;
    }

    public static function getAllGoodsYear($date)
    {
      $rwd = ReturnWarehouseDetail::select(DB::raw("SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs"))->whereDate('created_at',$date)->first();

      return $rwd;
    }

    public static function insertId($id_goods, $id_return_warehouse)
    {
      $rwd = new ReturnWarehouseDetail;
      $rwd->id_goods = $id_goods;
      $rwd->id_return_warehouse = $id_return_warehouse;
      $rwd->save();

      return $rwd;
    }

    public static function edit($id_goods, $qyt_box, $qyt_pcs, $bad_box, $bad_pcs, $desc, $id_rew)
    {
      $goods = Good::find($id_goods);
      $rwd = ReturnWarehouseDetail::where('id_goods',$id_goods)->where('id_return_warehouse',$id_rew)->first();

      $goods->qyt_box = $goods->qyt_box - $rwd->qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs - $rwd->qyt_pcs;
      $goods->bad_stock_box = $goods->bad_stock_box - $rwd->bad_stock_box;
      $goods->bad_stock_pcs = $goods->bad_stock_pcs - $rwd->bad_stock_pcs;
      $goods->save();

      $rwd->qyt_box = $qyt_box;
      $rwd->qyt_pcs = $qyt_pcs;
      $rwd->bad_stock_box = $bad_box;
      $rwd->bad_stock_pcs = $bad_pcs;
      $rwd->description = $desc;
      $rwd->save();

      $goods->qyt_box = $goods->qyt_box + $qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs + $qyt_pcs;
      $goods->bad_stock_box = $goods->bad_stock_box + $bad_box;
      $goods->bad_stock_pcs = $goods->bad_stock_pcs + $bad_pcs;
      $goods->save();

      return $rwd;
    }

    public static function destroys($id_goods, $id_rew)
    {
      $goods = Good::find($id_goods);
      $rwd = ReturnWarehouseDetail::where('id_goods',$id_goods)->where('id_return_warehouse',$id_rew)->first();

      $goods->qyt_box = $goods->qyt_box - $rwd->qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs - $rwd->qyt_pcs;
      $goods->bad_stock_box = $goods->bad_stock_box - $rwd->bad_stock_box;
      $goods->bad_stock_pcs = $goods->bad_stock_pcs - $rwd->bad_stock_pcs;
      $goods->save();

      $rwd->delete();

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
