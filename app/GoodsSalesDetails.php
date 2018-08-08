<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;

class GoodsSalesDetails extends Model
{
    protected $table = "goods_sales_details";

    public static function getIdGoodsSales($id_goods_sales)
    {
      $gsd = GoodsSalesDetails::where('id_goods_sales',$id_goods_sales)->get();

      return $gsd;
    }

    public static function getId($id)
    {
      $gsd = GoodsSalesDetails::find($id);

      return $gsd;
    }

    public static function insertId($id_goods, $id_goods_sales)
    {
      $gsd = new GoodsSalesDetails;
      $gsd->id_goods = $id_goods;
      $gsd->id_goods_sales = $id_goods_sales;
      $gsd->save();

      return $gsd;
    }

    public static function edit($id_goods, $qyt_box, $qyt_pcs, $desc, $id_goods_sales)
    {
      $goods = Good::find($id_goods);
      $gsd = GoodsSalesDetails::where('id_goods',$id_goods)->where('id_goods_sales',$id_goods_sales)->first();

      $goods->qyt_box = $goods->qyt_box + $gsd->qyt_box_out;
      $goods->qyt_pcs = $goods->qyt_pcs + $gsd->qyt_pcs_out;
      $goods->save();

      $gsd->qyt_box_out = $qyt_box;
      $gsd->qyt_pcs_out = $qyt_pcs;
      $gsd->description = $desc;
      $gsd->save();

      $goods->qyt_box = $goods->qyt_box - $qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs - $qyt_pcs;
      $goods->save();

      return $gsd;
    }

    public static function destroyGoodsSales($id_goods_sales)
    {
      $gsd = GoodsSalesDetails::where('id_goods_sales',$id_goods_sales)->first();

      $good = Good::find($gsd->id_goods);

      $good->qyt_box = $good->qyt_box + $gsd->qyt_box_out;
      $good->qyt_pcs = $good->qyt_pcs + $gsd->qyt_pcs_out;
      $good->save();

      $gsd->delete();

      return $gsd;
    }

    public static function destroy($id)
    {
      $gsd = GoodsSalesDetails::find($id);
      $good = Good::find($gsd->id_goods);

      $good->qyt_box = $good->qyt_box + $gsd->qyt_box_out;
      $good->qyt_pcs = $good->qyt_pcs + $gsd->qyt_pcs_out;
      $good->save();

      $gsd->delete();

      return $gsd;
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }

    public function goodsSales()
    {
      return $this->belongsTo('App\GoodsSales','id_goods_sales');
    }
}
