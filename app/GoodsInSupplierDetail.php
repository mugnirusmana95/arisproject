<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;
use DB;

class GoodsInSupplierDetail extends Model
{
    public $table = "goods_in_supplier_details";

    public static function getAll()
    {
      $gisd = GoodsInSupplierDetail::orderBy('created_at')->get();

      return $gisd;
    }

    public static function getId($id)
    {
      $gisd = GoodsInSupplierDetail::find($id);

      return $gisd;
    }

    public static function getIdGoodsInSupplier($id_goods_in_supplier)
    {
      $gisd = GoodsInSupplierDetail::where('id_goods_in_supplier',$id_goods_in_supplier)->get();

      return $gisd;
    }

    public static function getRangeDate($start, $end)
    {
      $gisd = GoodsInSupplierDetail::with('goods')->select(DB::raw('id_goods, SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs, SUM(bad_stock_box) as bad_stock_box, SUM(bad_stock_pcs) as bad_stock_pcs'))->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end)->groupBy('id_goods')->get();

      return $gisd;
    }

    public static function getDate($date)
    {
      $gisd = GoodsInSupplierDetail::with('goods')->select(DB::raw('id_goods, SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs, SUM(bad_stock_box) as bad_stock_box, SUM(bad_stock_pcs) as bad_stock_pcs'))->whereDate('created_at',$date)->groupBy('id_goods')->get();

      return $gisd;
    }

    public static function getGoodsDate($id_goods, $date)
    {
      $gisd = GoodsInSupplierDetail::select(DB::raw('id_goods, SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs'))->where('id_goods',$id_goods)->whereDate('created_at',$date)->groupBy('id_goods')->first();

      return $gisd;
    }

    public static function getGoodsDateBack($id_goods, $date)
    {
      $gisd = GoodsInSupplierDetail::select(DB::raw('id_goods, SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs'))->where('id_goods',$id_goods)->whereDate('created_at','<=',$date)->groupBy('id_goods')->first();

      return $gisd;
    }

    public static function getGoodsYear($year)
    {
      $gisd = GoodsInSupplierDetail::select(DB::raw('SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs'))->whereDate('created_at','LIKE','%'.$year.'%')->first();

      return $gisd;
    }

    public static function getAllGoodsYear($date)
    {
      $gisd = GoodsInSupplierDetail::select(DB::raw('SUM(qyt_box) as qyt_box, SUM(qyt_pcs) as qyt_pcs'))->whereDate('created_at',$date)->first();

      return $gisd;
    }

    public static function insert($id_goods_in_supplier, $id_goods, $qyt_box, $qyt_pcs, $description)
    {
      $gisd = new GoodsInSupplierDetail;
      $gisd->qyt_box = $qyt_box;
      $gisd->qyt_pcs = $qyt_pcs;
      $gisd->description = $description;
      $gisd->id_goods = $id_goods;
      $gisd->id_goods_in_supplier = $id_goods_in_supplier;
      $gisd->save();

      $good = Good::find($id_goods);
      $good->qyt_box = $good->qyt_box + $qyt_box;
      $good->qyt_pcs = $good->qyt_pcs + $qyt_pcs;
      $good->save();
    }

    public static function edit($id, $qyt_box, $qyt_pcs, $description, $id_goods, $id_goods_in_supplier)
    {
      $gisd = GoodsInSupplierDetail::find($id);
      $good = Good::find($id_goods);

      $good->qyt_box = ($good->qyt_box - $gisd->qyt_box) + $qyt_box;
      $good->qyt_pcs = ($good->qyt_pcs - $gisd->qyt_pcs) + $qyt_pcs;
      $good->save();

      $gisd->qyt_box = $qyt_box;
      $gisd->qyt_pcs = $qyt_pcs;
      $gisd->description = $description;
      $gisd->id_goods = $id_goods;
      $gisd->id_goods_in_supplier = $id_goods_in_supplier;
      $gisd->save();
    }

    public static function insertOrEdit($id, $qyt_box, $qyt_pcs, $description, $id_goods, $id_goods_in_supplier)
    {
      if ($id == null) {
        $gisd = new GoodsInSupplierDetail;
        $gisd->qyt_box = $qyt_box;
        $gisd->qyt_pcs = $qyt_pcs;
        $gisd->description = $description;
        $gisd->id_goods = $id_goods;
        $gisd->id_goods_in_supplier = $id_goods_in_supplier;
        $gisd->save();

        $good = Good::find($id_goods);
        $good->qyt_box = $good->qyt_box + $qyt_box;
        $good->qyt_pcs = $good->qyt_pcs + $qyt_pcs;
        $good->save();
      } else {
        $gisd = GoodsInSupplierDetail::find($id);
        $good = Good::find($gisd->id_goods);

        $good->qyt_box = ($good->qyt_box - $gisd->qyt_box) + $qyt_box;
        $good->qyt_pcs = ($good->qyt_pcs - $gisd->qyt_pcs) + $qyt_pcs;
        $good->save();

        $gisd->qyt_box = $qyt_box;
        $gisd->qyt_pcs = $qyt_pcs;
        $gisd->description = $description;
        $gisd->id_goods = $id_goods;
        $gisd->id_goods_in_supplier = $id_goods_in_supplier;
        $gisd->save();

        return $gisd;
      }
    }

    public static function destroy($id)
    {
      $gisd = GoodsInSupplierDetail::find($id);
      $good = Good::find($gisd->id_goods);

      $good->qyt_box = $good->qyt_box - $gisd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs - $gisd->qyt_pcs;
      $good->save();

      $gisd->delete();

      return $gisd;
    }

    public static function destroyGoodInSupplier($id_goods_in_supplier)
    {
      $gisd = GoodsInSupplierDetail::where('id_goods_in_supplier',$id_goods_in_supplier)->first();

      $good = Good::find($gisd->id_goods);

      $good->qyt_box = $good->qyt_box - $gisd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs - $gisd->qyt_pcs;
      $good->save();

      $gisd->delete();

      return $gisd;
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }

    public function goodsInSupplierDetail()
    {
      return $this->belongsTo('App\GoodsInSupplier','id_goods_in_supplier');
    }
}
