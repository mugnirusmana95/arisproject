<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;
use DB;

class GoodsOutWarehouseDetail extends Model
{
    public $table = "goods_out_warehouse_details";

    public static function getId($id)
    {
      $gowd = GoodsOutWarehouseDetail::find($id);

      return $gowd;
    }

    public static function getIdGoodsOutWarehouse($id_goods_out_warehouse)
    {
      $gowd = GoodsOutWarehouseDetail::where('id_goods_out_warehouse',$id_goods_out_warehouse)->get();

      return $gowd;
    }

    public static function getGoodsReturn($id, $search)
    {
      $gowd  = DB::select(DB::raw(
        "SELECT
          a.id_goods as id,
          b.name as name
        FROM goods_out_warehouse_details a
        LEFT JOIN goods b
        ON a.id_goods=b.id
        WHERE a.id_goods_out_warehouse='$id'
        AND b.name LIKE '%$search%' AND a.id_goods NOT IN
        (SELECT
            c.id_goods
         FROM return_warehouses_details c
         LEFT JOIN return_warehouses d
         ON c.id_return_warehouse=d.id
         WHERE d.id_goods_out_warehouse='$id'
        )"
      ));

      $data = [];

      foreach ($gowd as $key) {
        $data[] = ['id' => $key->id, 'text' => $key->name];
      }

      return $data;
    }

    public static function getOneGoods($id_goods, $id_gow)
    {
      $gowd = GoodsOutWarehouseDetail::where('id_goods',$id_goods)->where('id_goods_out_warehouse',$id_gow)->first();

      return $gowd;
    }

    public static function insertId($id_goods, $id_goods_out_warehouse)
    {
      $gowd = new GoodsOutWarehouseDetail;
      $gowd->id_goods = $id_goods;
      $gowd->id_goods_out_warehouse = $id_goods_out_warehouse;
      $gowd->save();

      return $gowd;
    }

    public static function edit($id_goods, $qyt_box, $qyt_pcs, $desc, $id_goods_out_warehouse)
    {
      $goods = Good::find($id_goods);
      $gowd = GoodsOutWarehouseDetail::where('id_goods',$id_goods)->where('id_goods_out_warehouse',$id_goods_out_warehouse)->first();

      $goods->qyt_box = $goods->qyt_box + $gowd->qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs + $gowd->qyt_pcs;
      $goods->save();

      $gowd->qyt_box = $qyt_box;
      $gowd->qyt_pcs = $qyt_pcs;
      $gowd->description = $desc;
      $gowd->save();

      $goods->qyt_box = $goods->qyt_box - $qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs - $qyt_pcs;
      $goods->save();

      return $gowd;
    }

    public static function destroy($id)
    {
      $gowd = GoodsOutWarehouseDetail::find($id);
      $good = Good::find($gowd->id_goods);

      $good->qyt_box = $good->qyt_box + $gowd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs + $gowd->qyt_pcs;
      $good->save();

      $gowd->delete();

      return $gowd;
    }

    public static function destroyGoodOutWarehouse($id_goods_out_warehouse)
    {
      $gowd = GoodsOutWarehouseDetail::where('id_goods_out_warehouse',$id_goods_out_warehouse)->first();

      $good = Good::find($gowd->id_goods);

      $good->qyt_box = $good->qyt_box + $gowd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs + $gowd->qyt_pcs;
      $good->save();

      $gowd->delete();

      return $gowd;
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }

    public function goodsOutWarehouse()
    {
      return $this->belongsTo('App\GoodsOutWarehouse','id_goods_out_warehouse');
    }
}
