<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSales;

class DashboardController extends Controller
{
    public function index()
    {
      $out = 1;
      $data['gos'] = GoodsSales::getStatus($out);
      $data['no_sales'] = 1;
      
      return view('dashboard.index',$data);
    }
}
