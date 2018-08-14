<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;
use DB;

class GoodsInWarehouseDetail extends Model
{
    public $table = "goods_in_warehouse_details";

    public static function getAll()
    {
      $giwd = GoodsInWarehouseDetail::orderBy('created_at')->get();

      return $giwd;
    }

    public static function getId($id)
    {
      $giwd = GoodsInWarehouseDetail::find($id);

      return $giwd;
    }

    public static function getIdGoodsInWarehouse($id_goods_in_warehouse)
    {
      $giwd = GoodsInWarehouseDetail::where('id_goods_in_warehouse',$id_goods_in_warehouse)->get();

      return $giwd;
    }

    public static function getRangeDate($start, $end)
    {
      $giwd = GoodsInWarehouseDetail::with('goods')->select(DB::raw('id_goods, SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs, SUM(bad_stock_box) as bad_stock_box, SUM(bad_stock_pcs) as bad_stock_pcs'))->where('created_at','>=',$start)->where('created_at','<=',$end)->groupBy('id_goods')->get();

      return $giwd;
    }

    public static function insert($id_goods_in_warehouse, $id_goods, $qyt_box, $qyt_pcs, $description)
    {
      $giwd = new GoodsInWarehouseDetail;
      $giwd->qyt_box = $qyt_box;
      $giwd->qyt_pcs = $qyt_pcs;
      $giwd->description = $description;
      $giwd->id_goods = $id_goods;
      $giwd->id_goods_in_warehouse = $id_goods_in_warehouse;
      $giwd->save();

      $good = Good::find($id_goods);
      $good->qyt_box = $good->qyt_box + $qyt_box;
      $good->qyt_pcs = $good->qyt_pcs + $qyt_pcs;
      $good->save();

      return $giwd;
    }

    public static function edit($id, $qyt_box, $qyt_pcs, $description, $id_goods, $id_goods_in_warehouse)
    {
      $giwd = GoodsInWarehouseDetail::find($id);
      $goods = Good::find($id_goods);

      if ($giwd->id_goods===$id_goods) {
        $goods->qyt_box = ($goods->qyt_box - $giwd->qyt_box) + $qyt_box;
        $goods->qyt_pcs = ($goods->qyt_pcs - $giwd->qyt_pcs) + $qyt_pcs;
        $goods->save();

        $giwd->qyt_box = $qyt_box;
        $giwd->qyt_pcs = $qyt_pcs;
        $giwd->description = $description;
        $giwd->save();
      } else {
        $giwd2  = GoodsInWarehouseDetail::where('id_goods',$id_goods)->where('id_goods_in_warehouse',$id_goods_in_warehouse)->first();
        $goods2  = Good::find($giwd->id_goods);

        if (count($giwd2)>0) {
          $giwd2->qyt_box     = $giwd2->qyt_box + $qyt_box;
          $giwd2->qyt_pcs     = $giwd2->qyt_pcs + $qyt_pcs;
          $giwd2->description = $giwd2->description.". ".$description;
          $giwd2->save();
        } else {
          $giwd3 = new GoodsInWarehouseDetail;
          $giwd3->qyt_box     = $qyt_box;
          $giwd3->qyt_pcs     = $qyt_pcs;
          $giwd3->description = $description;
          $giwd3->id_goods    = $id_goods;
          $giwd3->id_goods_in_warehouse = $id_goods_in_warehouse;
          $giwd3->save();
        }

        $goods2->qyt_box = $goods2->qyt_box - $giwd->qyt_box;
        $goods2->qyt_pcs = $goods2->qyt_pcs - $giwd->qyt_pcs;
        $goods2->save();

        $goods->qyt_box = $goods->qyt_box + $qyt_box;
        $goods->qyt_pcs = $goods->qyt_pcs + $qyt_pcs;
        $goods->save();

        $giwd->delete();
      }

      return $giwd;
    }

    public static function insertOrEdit($qyt_box, $qyt_pcs, $description, $id_goods, $id_goods_in_warehouse)
    {
      $cek = GoodsInWarehouseDetail::where('id_goods',$id_goods)->where('id_goods_in_warehouse',$id_goods_in_warehouse)->first();

      if (count($cek)>0) {
        $giwd = GoodsInWarehouseDetail::find($cek->id);
        $goods = Good::find($id_goods);

        $giwd->qyt_box        = $giwd->qyt_box + $qyt_box;
        $giwd->qyt_pcs        = $giwd->qyt_pcs + $qyt_pcs;
        if ($description === null || $description === "") {
          $giwd->description  = $giwd->description;
        } else {
          $giwd->description  = $giwd->description.'. '.$description;
        }
        $giwd->save();

        $goods->qyt_box = $goods->qyt_box + $qyt_box;
        $goods->qyt_pcs = $goods->qyt_pcs + $qyt_pcs;
        $goods->save();
      } else {
        $giwd = new GoodsInWarehouseDetail;
        $goods = Good::find($id_goods);

        $giwd->qyt_box                = $qyt_box;
        $giwd->qyt_pcs                = $qyt_pcs;
        $giwd->description            = $description;
        $giwd->id_goods               = $id_goods;
        $giwd->id_goods_in_warehouse  = $id_goods_in_warehouse;
        $giwd->save();

        $goods->qyt_box               = $goods->qyt_box + $qyt_box;
        $goods->qyt_pcs               = $goods->qyt_pcs + $qyt_pcs;
        $goods->save();
      }

      return $giwd;
    }

    public static function destroy($id)
    {
      $giwd = GoodsInWarehouseDetail::find($id);
      $good = Good::find($giwd->id_goods);

      $good->qyt_box = $good->qyt_box - $giwd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs - $giwd->qyt_pcs;
      $good->save();

      $giwd->delete();

      return $giwd;
    }

    public static function destroyGoodInWarehouse($id_goods_in_warehouse)
    {
      $giwd = GoodsInWarehouseDetail::where('id_goods_in_warehouse',$id_goods_in_warehouse)->first();

      $good = Good::find($giwd->id_goods);

      $good->qyt_box = $good->qyt_box - $giwd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs - $giwd->qyt_pcs;
      $good->save();

      $giwd->delete();

      return $giwd;
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }

    public function goodsInWarehouse()
    {
      return $this->belongsTo('App\GoodsInWarehouse','id_goods_in_warehouse');
    }
}
