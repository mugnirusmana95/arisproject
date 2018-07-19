<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;

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
    }

    public static function edit($id, $qyt_box, $qyt_pcs, $description, $id_goods, $id_goods_in_warehouse)
    {
      $giwd = GoodsInWarehouseDetail::find($id);
      $good = Good::find($id_goods);

      $good->qyt_box = ($good->qyt_box - $giwd->qyt_box) + $qyt_box;
      $good->qyt_pcs = ($good->qyt_pcs - $giwd->qyt_pcs) + $qyt_pcs;
      $good->save();

      $giwd->qyt_box = $qyt_box;
      $giwd->qyt_pcs = $qyt_pcs;
      $giwd->description = $description;
      $giwd->id_goods = $id_goods;
      $giwd->id_goods_in_warehouse = $id_goods_in_warehouse;
      $giwd->save();
    }

    public static function insertOrEdit($id, $qyt_box, $qyt_pcs, $description, $id_goods, $id_goods_in_warehouse)
    {
      if ($id == null) {
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
      } else {
        $giwd = GoodsInWarehouseDetail::find($id);
        $good = Good::find($giwd->id_goods);

        $good->qyt_box = ($good->qyt_box - $giwd->qyt_box) + $qyt_box;
        $good->qyt_pcs = ($good->qyt_pcs - $giwd->qyt_pcs) + $qyt_pcs;
        $good->save();

        $giwd->qyt_box = $qyt_box;
        $giwd->qyt_pcs = $qyt_pcs;
        $giwd->description = $description;
        $giwd->id_goods = $id_goods;
        $giwd->id_goods_in_warehouse = $id_goods_in_warehouse;
        $giwd->save();

        return $giwd;
      }
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

    public function goodsInWarehouseDetail()
    {
      return $this->belongsTo('App\GoodsInWarehouse','id_goods_in_warehouse');
    }
}
