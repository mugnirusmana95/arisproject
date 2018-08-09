<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReturnWarehouse;
use App\ReturnWarehouseDetail;
use Session;

class GoodsInReturnWarehouseController extends Controller
{
    public function index()
    {
      $data['rw'] = ReturnWarehouse::getAll();
      $data['no'] = 1;

      return view('returnWarehouse.index',$data);
    }
}
