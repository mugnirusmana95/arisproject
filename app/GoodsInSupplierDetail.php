<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;

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

    public static function edit($id, $qyt_box, $qyt_pcs, $description, $id_goods_in_supplier)
    {
      $gisd = GoodsInSupplierDetail::find($id);
      $good = Good::find($gisd->id_goods);

      $good->qyt_box = ($good->qyt_box - $gisd->qyt_box) + $qyt_box;
      $good->qyt_pcs = ($good->qyt_pcs - $gisd->qyt_pcs) + $qyt_pcs;
      $good->save();

      $gisd->qyt_box = $qyt_box;
      $gisd->qyt_pcs = $qyt_pcs;
      $gisd->description = $description;
      $gisd->save();
    }

    public static function destroy($id)
    {
      $gisd = GoodsInSupplierDetail::find($id);
      $good = Good::find($gisd->id_goods);

      $good->qyt_box = $good->qyt_box - $gisd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs - $gisd->qyt_pcs;
      $good->save();

      $gisd->delete();
    }

    public static function destroyGoodInSupplier($id_goods_in_supplier)
    {
      $gisd = GoodsInSupplierDetail::where('id_goods_in_supplier',$id_goods_in_supplier)->first();

      $good = Good::find($gisd->id_goods);

      $good->qyt_box = $good->qyt_box - $gisd->qyt_box;
      $good->qyt_pcs = $good->qyt_pcs - $gisd->qyt_pcs;
      $good->save();

      $gisd->delete();
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }
}
