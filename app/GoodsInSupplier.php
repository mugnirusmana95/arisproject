<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoodsInSupplier extends Model
{
    protected $primaryKey = "id";
    public $table = "goods_in_suppliers";
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('goods_in_suppliers')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'GIS'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $gis = GoodsInSupplier::orderBy('created_at')->get();

      return $gis;
    }

    public static function getId($id)
    {
      $gis = GoodsInSupplier::find($id);

      return $gis;
    }

    public static function insert($id, $supplier)
    {
      $gis = new GoodsInSupplier;
      $gis->id = $id;
      $gis->id_supplier = $supplier;
      $gis->save();
    }

    public static function destroy($id)
    {
      $gis = GoodsInSupplier::find($id);
      $gis->delete();
    }

    public function supplier()
    {
      return $this->belongsTo('App\Supplier','id_supplier');
    }
}
