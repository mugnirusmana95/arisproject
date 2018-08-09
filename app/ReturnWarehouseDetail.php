<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnWarehouseDetail extends Model
{
    protected $table = "return_warehouses_details";

    public function getId($id)
    {
      $rwd = ReturnWarehouseDetail::find($id);

      return $rwd;
    }

    public function getIdReturnWarehouse($id_return_warehouse)
    {
      $rwd = ReturnWarehouseDetail::where('id_return_warehouse',$id_return_warehouse)->get();

      return $rwd;
    }

    public function goods()
    {
      return $this->belongsTo('App\Good','id_goods');
    }

    public function returnWarehouse()
    {
      return $this->belongsTo('App\ReturnWarehouse','id_return_warehouse');
    }
}
