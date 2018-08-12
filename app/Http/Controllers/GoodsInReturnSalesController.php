<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReturnSales;
use App\ReturnSalesDetail;
use App\GoodsOutSales;
use Session;

class GoodsInReturnSalesController extends Controller
{
    public function index()
    {
      $data['rs'] = ReturnSales::getAll();
      $data['no'] = 1;

      return view('returnSales.index',$data);
    }

    public function create()
    {
      return view('returnSales.create');
    }
}
