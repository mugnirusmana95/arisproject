<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;
use DB;

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

    public static function getGoodsReturn($id, $search)
    {
      $gsd  = DB::select(DB::raw(
        "SELECT
          a.id_goods as id,
          b.name as name
        FROM goods_sales_details a
        LEFT JOIN goods b
        ON a.id_goods=b.id
        WHERE a.id_goods_sales='$id'
        AND b.name LIKE '%$search%' AND a.id_goods NOT IN
        (SELECT
            c.id_goods
         FROM return_sales_details c
         LEFT JOIN return_sales d
         ON c.id_return_sales=d.id
         WHERE d.id_goods_out_sales='$id'
        )"
      ));

      $data = [];

      foreach ($gsd as $key) {
        $data[] = ['id' => $key->id, 'text' => $key->name];
      }

      return $data;
    }

    public static function getOneGoods($id_goods, $id_gs)
    {
      $gsd = GoodsSalesDetails::where('id_goods',$id_goods)->where('id_goods_sales',$id_gs)->first();

      return $gsd;
    }

    public static function getSumIdGoodsSales($id_gs)
    {
      $gsd = GoodsSalesDetails::select(DB::raw('sum(qyt_box_out) as qyt_box, sum(qyt_pcs_out) as qyt_pcs'))->where('id_goods_sales',$id_gs)->first();

      return $gsd;
    }

    public static function getInRangeDate($start, $end)
    {
      $gsd = DB::select(DB::raw(
        "SELECT
          c.name as name,
          SUM(a.qyt_box_in) as qyt_box,
          SUM(a.qyt_pcs_in) as qyt_pcs,
          SUM(a.bad_stok_box) as bad_stock_box,
          SUM(a.bad_stok_pcs) as bad_stock_pcs
        FROM goods_sales_details a
        LEFT JOIN goods_sales b
        ON a.id_goods_sales=b.id
        LEFT JOIN goods c
        ON a.id_goods=c.id
        WHERE b.status=2
        AND DATE(a.created_at) >= '$start'
        AND DATE(a.created_at) <= '$end'
        GROUP BY a.id_goods
        Order By c.name ASC
        "
      ));

      return $gsd;
    }

    public static function getInDate($date)
    {
      $gsd = DB::select(DB::raw(
        "SELECT
          c.name as name,
          SUM(a.qyt_box_in) as qyt_box,
          SUM(a.qyt_pcs_in) as qyt_pcs,
          SUM(a.bad_stok_box) as bad_stock_box,
          SUM(a.bad_stok_pcs) as bad_stock_pcs
        FROM goods_sales_details a
        LEFT JOIN goods_sales b
        ON a.id_goods_sales=b.id
        LEFT JOIN goods c
        ON a.id_goods=c.id
        WHERE b.status=2
        AND DATE(a.created_at) = '$date'
        GROUP BY a.id_goods
        Order By c.name ASC
        "
      ));

      return $gsd;
    }

    public static function getInGoodsDate($id_goods, $date)
    {
      $gsd =  DB::table('goods_sales_details')
              ->select(DB::raw("id_goods, SUM(qyt_box_in) as qyt_box, SUM(qyt_pcs_in) as qyt_pcs"))
              ->leftJoin('goods_sales','goods_sales.id','=','goods_sales_details.id_goods_sales')
              ->where('goods_sales.status','2')
              ->where('id_goods',$id_goods)
              ->whereDate('goods_sales_details.created_at','=',$date)
              ->groupBy('id_goods')
              ->first();

      return $gsd;
    }

    public static function getOutGoodsDate($id_goods, $date)
    {
      $gsd =  DB::table('goods_sales_details')
              ->select(DB::raw("id_goods, SUM(qyt_box_out) as qyt_box, SUM(qyt_pcs_out) as qyt_pcs"))
              ->leftJoin('goods_sales','goods_sales.id','=','goods_sales_details.id_goods_sales')
              ->where('id_goods',$id_goods)
              ->whereDate('goods_sales_details.created_at',$date)
              ->groupBy('id_goods')
              ->first();

      return $gsd;
    }

    public static function getInGoodsDateBack($id_goods, $date)
    {
      $gsd =  DB::table('goods_sales_details')
              ->select(DB::raw("id_goods, SUM(qyt_box_in) as qyt_box, SUM(qyt_pcs_in) as qyt_pcs"))
              ->leftJoin('goods_sales','goods_sales.id','=','goods_sales_details.id_goods_sales')
              ->where('goods_sales.status','2')
              ->where('id_goods',$id_goods)
              ->whereDate('goods_sales_details.created_at','<=',$date)
              ->groupBy('id_goods')
              ->first();

      return $gsd;
    }

    public static function getOutRangeDate($start, $end)
    {
      $gsd = GoodsSalesDetails::with('goods')->select(DB::raw('id_goods, SUM(qyt_box_out) as qyt_box, SUM(qyt_pcs_out) as qyt_pcs'))->where('created_at','>=',$start)->where('created_at','<=',$end)->groupBy('id_goods')->get();

      return $gsd;
    }

    public static function getOutDate($date)
    {
      $gsd = GoodsSalesDetails::with('goods')->select(DB::raw("id_goods, SUM(qyt_box_out) as qyt_box, SUM(qyt_pcs_out) as qyt_pcs"))->whereDate('created_at',$date)->groupBy('id_goods')->get();

      return $gsd;
    }

    public static function getInGoodsYear($year)
    {
      $gsd = GoodsSalesDetails::select(DB::raw("SUM(qyt_box_in) as qyt_box, SUM(qyt_pcs_in) as qyt_pcs"))->whereDate('created_at','LIKE','%'.$year.'%')->first();

      return $gsd;
    }

    public static function getOutGoodsYear($year)
    {
      $gsd = GoodsSalesDetails::select(DB::raw("SUM(qyt_box_out) as qyt_box, SUM(qyt_pcs_out) as qyt_pcs"))->whereDate('created_at','LIKE','%'.$year.'%')->first();

      return $gsd;
    }

    public static function getInAllGoodsYear($date)
    {
      $gsd = GoodsSalesDetails::select(DB::raw('SUM(qyt_box_in) as qyt_box, SUM(qyt_pcs_in) as qyt_pcs'))->whereDate('created_at',$date)->first();

      return $gsd;
    }

    public static function getOutAllGoodsYear($date)
    {
      $gsd = GoodsSalesDetails::select(DB::raw('SUM(qyt_box_out) as qyt_box, SUM(qyt_pcs_out) as qyt_pcs'))->whereDate('created_at',$date)->first();

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
