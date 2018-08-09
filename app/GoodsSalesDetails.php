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

    public static function editIn($id_goods, $qyt_box, $qyt_pcs, $bad_box, $bad_pcs, $id_goods_sales)
    {
      $goods = Good::find($id_goods);
      $gsd = GoodsSalesDetails::where('id_goods',$id_goods)->where('id_goods_sales',$id_goods_sales)->first();

      $goods->qyt_box = $goods->qyt_box - $gsd->qyt_box_in;
      $goods->qyt_pcs = $goods->qyt_pcs - $gsd->qyt_pcs_in;
      $goods->bad_stock_box = $goods->bad_stock_box - $gsd->bad_stok_box;
      $goods->bad_stock_pcs = $goods->bad_stock_pcs - $gsd->bad_stok_pcs;
      $goods->save();

      $gsd->qyt_box_in = $qyt_box;
      $gsd->qyt_pcs_in = $qyt_pcs;
      $gsd->bad_stok_box = $bad_box;
      $gsd->bad_stok_pcs = $bad_pcs;
      $gsd->save();

      $goods->qyt_box = $goods->qyt_box + $qyt_box;
      $goods->qyt_pcs = $goods->qyt_pcs + $qyt_pcs;
      $goods->bad_stock_box = $goods->bad_stock_box + $bad_box;
      $goods->bad_stock_pcs = $goods->bad_stock_pcs + $bad_pcs;
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

    public static function destroyGoodsSalesOut($id_goods, $id_goods_sales)
    {
      $gsd = GoodsSalesDetails::where('id_goods_sales',$id_goods_sales)->where('id_goods',$id_goods)->first();

      $good = Good::find($id_goods);

      $good->qyt_box = ($good->qyt_box - $gsd->qyt_box_in) + $gsd->qyt_box_out;
      $good->qyt_pcs = ($good->qyt_pcs - $gsd->qyt_pcs_in) + $gsd->qyt_pcs_out;
      $good->bad_stock_box = $good->bad_stock_box - $gsd->bad_stok_box;
      $good->bad_stock_pcs = $good->bad_stock_pcs - $gsd->bad_stok_pcs;
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

    public static function destroyOut($id)
    {
      $gsd = GoodsSalesDetails::find($id);

      $good = Good::find($gsd->id_goods);

      $good->qyt_box = ($good->qyt_box - $gsd->qyt_box_in) + $gsd->qyt_box_out;
      $good->qyt_pcs = ($good->qyt_pcs - $gsd->qyt_pcs_in) + $gsd->qyt_pcs_out;
      $good->bad_stock_box = $good->bad_stock_box - $gsd->bad_stok_box;
      $good->bad_stock_pcs = $good->bad_stock_pcs - $gsd->bad_stok_pcs;
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
