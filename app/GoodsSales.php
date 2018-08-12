<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoodsSales extends Model
{
    protected $table = "goods_sales";
    protected $primaryKey = "id";
    public $incrementing = false;

    public static function getNewId()
    {
      $today = date('ymd');
      $query = DB::table('goods_sales')
          ->where('id','LIKE','%'.$today.'%')
          ->max('id');
      $nourut = (int) substr($query, 10, 4);
      $nourut++;
      $id = 'GOS'.$today.sprintf('%04s', $nourut);

      return $id;
    }

    public static function getId($id)
    {
      $gs = GoodsSales::find($id);

      return $gs;
    }

    public static function getAll()
    {
      $gs = GoodsSales::orderBy('created_at','DESC')->get();

      return $gs;
    }

    public static function insert($id, $sales, $description)
    {
      $gs = new GoodsSales;
      $gs->id = $id;
      $gs->id_sales = $sales;
      $gs->description = $description;
      $gs->status = 1;
      $gs->save();

      return $gs;
    }

    public static function edit($id, $sales, $description)
    {
      $gs = GoodsSales::find($id);
      $gs->id_sales = $sales;
      $gs->description = $description;
      $gs->save();
    }

    public static function destroy($id)
    {
      $gs = GoodsSales::find($id);
      $gs->delete();

      return $gs;
    }

    public static function goodsBack($id)
    {
      $gs = GoodsSales::find($id);
      $gs->status = 2;
      $gs->save();

      return $gs;
    }

    public static function getAllReturn($search)
    {
      $gs = DB::select(
              DB::raw(
                "SELECT
                  a.id,
                  b.name as name_sales
                FROM goods_sales a
                LEFT JOIN sales b
                ON a.id_sales=b.id
                WHERE (a.id LIKE '%$search%' OR b.name LIKE '%$search%') AND a.id NOT IN
                  (SELECT c.id_goods_out_sales FROM return_sales c)
                LIMIT 0,10
              ")
             );

      $data = [];

      foreach ($gs as $key) {
        $data[] = ['id'=>$key->id, 'text'=>$key->id.' - '.$key->name_sales];
      }

      return $data;
    }

    public function sales()
    {
      return $this->belongsTo('App\Sales','id_sales');
    }

    public function goodsSalesDetail()
    {
      return $this->hasMany('App\GoodsSalesDetail');
    }
}
