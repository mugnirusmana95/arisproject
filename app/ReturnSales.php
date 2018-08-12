<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReturnSalesDetail;
use DB;

class ReturnSales extends Model
{
    protected $table = "return_sales";
    protected $primaryKey = "id";
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('return_sales')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'RES'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getAll()
    {
      $rs = ReturnSales::orderBy('created_at','DESC')->get();

      return $rs;
    }

    public static function getId($id)
    {
      $rs = ReturnSales::find($id);

      return $rs;
    }

    public static function getIdGoodsOutSales($id_gos)
    {
      $rs = ReturnSales::where('id_goods_out_sales',$id_gos)->first();

      return $rs;
    }

    public static function insert($id, $date, $description, $id_gos)
    {
      $rs = new ReturnSales;
      $rs->id = $id;
      $rs->date = $date;
      $rs->description = $description;
      $rs->id_goods_out_sales = $id_gos;
      $rs->save();

      return $rs;
    }

    public static function editDescription($desc, $id_res)
    {
      $rs = ReturnSales::find($id_res);
      $rs->description = $desc;
      $rs->save();

      return $rs;
    }

    public static function destroys($id)
    {
      $rs = ReturnSales::find($id);
      $rs->delete();

      return $rs;
    }

    public function goodsOutSales()
    {
      return $this->belongsTo('App\GoodsOutSales','id_goods_out_sales');
    }

    public function goodsReturnSalesDetail()
    {
      return $this->hasMany('App\ReturnSalesDetail');
    }
}
