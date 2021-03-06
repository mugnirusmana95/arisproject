<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoodsOutWarehouse extends Model
{
    public $table = "goods_out_warehouses";
    protected $primaryKey = "id";
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('goods_out_warehouses')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'GOW'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $gow = GoodsOutWarehouse::orderBy('created_at')->get();

      return $gow;
    }

    public static function getAllReturn($search)
    {
      $gow = DB::select(
              DB::raw(
                "SELECT
                  a.id,
                  b.name as name_warehouse
                FROM goods_out_warehouses a
                LEFT JOIN warehouses b
                ON a.id_warehouse=b.id
                WHERE (a.id LIKE '%$search%' OR b.name LIKE '%$search%') AND a.id NOT IN
                  (SELECT c.id_goods_out_warehouse FROM return_warehouses c)
                LIMIT 0,10
              ")
             );

     $data = [];

     foreach ($gow as $key) {
       $data[] = ['id'=>$key->id, 'text'=>$key->id.' - '.$key->name_warehouse];
     }

      return $data;
    }

    public static function getId($id)
    {
      $gow = GoodsOutWarehouse::find($id);

      return $gow;
    }

    public static function insert($id, $id_warehouse, $description)
    {
      $gow = new GoodsOutWarehouse;
      $gow->id = $id;
      $gow->id_warehouse = $id_warehouse;
      $gow->description = $description;
      $gow->save();

      return $gow;
    }

    public static function edit($id, $id_warehouse, $description)
    {
      $gow = GoodsOutWarehouse::find($id);
      $gow->id_warehouse = $id_warehouse;
      $gow->description = $description;
      $gow->save();

      return $gow;
    }

    public static function destroy($id)
    {
      $gow = GoodsOutWarehouse::find($id);
      $gow->delete();

      return $gow;
    }

    public function warehouse()
    {
      return $this->belongsTo('App\Warehouse','id_warehouse');
    }

    public function goodsOutWarehouseDetail()
    {
      return $this->hasMany('App\GoodsOutWarehouseDetail');
    }
}
