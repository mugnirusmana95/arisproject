<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReturnSales;
use App\ReturnSalesDetail;

class ReturnSalesDetail extends Model
{
    protected $table = "return_saless_details";

    public static function getId($id)
    {
      $rwd = ReturnSalesDetail::find($id);

      return $rwd;
    }

    public static function getIdReturnSales($id_return_sales)
    {
      $rwd = ReturnSalesDetail::where('id_return_sales',$id_return_sales)->get();

      return $rwd;
    }

    public static function getIdGoods($id_goods, $id_gos)
    {
      $rwd = DB::table('return_saless_details')
                  ->join('return_saless','return_saless_details.id_return_sales','=','return_saless.id')
                  ->where('return_saless_details.id_goods',$id_goods)
                  ->where('return_saless.id_goods_out_sales',$id_gos)
                  ->get();
      return $rwd;
    }

    public static function getOneGoods($id_goods, $id_res)
    {
      $rwd = ReturnSalesDetail::where('id_goods',$id_goods)->where('id_return_sales',$id_res)->first();

      return $rwd;
    }

    public static function insertId($id_goods, $id_return_sales)
    {
      $rwd = new ReturnSalesDetail;
      $rwd->id_goods = $id_goods;
      $rwd->id_return_sales = $id_return_sales;
      $rwd->save();

      return $rwd;
    }

    public static function edit($id_goods, $qyt_box, $qyt_pcs, $bad_box, $bad_pcs, $desc, $id_res)
    {
      $goods = Good::find($id_goods);
      $rwd = ReturnSalesDetail::where('id_goods',$id_goods)->where('id_return_sales',$id_res)->first();

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

    public static function destroys($id_goods, $id_res)
    {
      $goods = Good::find($id_goods);
      $rwd = ReturnSalesDetail::where('id_goods',$id_goods)->where('id_return_sales',$id_res)->first();

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

    public function ReturnSales()
    {
      return $this->belongsTo('App\ReturnSales','id_return_sales');
    }
}
