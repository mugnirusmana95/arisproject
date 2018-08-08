<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Good extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('goods')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 8, 4);
      $nourut++;
      $id = 'B'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $good = Good::orderBy('name','ASC')->get();

      return $good;
    }

    public static function getAllReady()
    {
      $good = Good::where('qyt_box','>', 0)->where('qyt_pcs','>', 0)->get();

      return $good;
    }

    public static function getId($id)
    {
      $good = Good::find($id);

      return $good;
    }

    public static function insert($id, $name, $qyt_box, $qyt_pcs, $pcs_per_box, $bad_stock_box, $bad_stock_pcs)
    {
      $good = new Good;
      $good->id = $id;
      $good->name = $name;
      $good->qyt_box = $qyt_box;
      $good->qyt_pcs = $qyt_pcs;
      $good->pcs_per_box = $pcs_per_box;
      $good->bad_stock_box = $bad_stock_box;
      $good->bad_stock_pcs = $bad_stock_pcs;
      $good->save();
    }

    public static function edit($id, $name, $qyt_box, $qyt_pcs, $pcs_per_box, $bad_stock_box, $bad_stock_pcs)
    {
      $good = Good::find($id);
      $good->name = $name;
      $good->qyt_box = $qyt_box;
      $good->qyt_pcs = $qyt_pcs;
      $good->pcs_per_box = $pcs_per_box;
      $good->bad_stock_box = $bad_stock_box;
      $good->bad_stock_pcs = $bad_stock_pcs;
      $good->save();
    }

    public static function destroy($id)
    {
      $good = Good::find($id);
      $good->delete();
    }

    public static function getAllNotInWarehouseOut($id, $search)
    {
      $goods = DB::select(
              DB::raw(
                "SELECT id, name as text
                FROM goods
                WHERE name LIKE '%$search%' AND
                id NOT IN
                (SELECT id_goods FROM goods_out_warehouse_details WHERE id_goods_out_warehouse='$id')
                ORDER BY name ASC
                LIMIT 0,20"
              )
            );

      return $goods;
    }

    public static function getReady($search)
    {
      $goods = DB::select(
              DB::raw(
                "SELECT id, name as text
                FROM goods
                WHERE name LIKE '%$search%' AND
                (qyt_box >= 1 OR qyt_pcs >=1)
                ORDER BY name ASC
                LIMIT 0,20"
              )
            );

      return $goods;
    }

    public function gisd()
    {
      return $this->hasMany('App\GoodsInSupplierDetail');
    }
}
