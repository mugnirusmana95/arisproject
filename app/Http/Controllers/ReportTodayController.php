<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;

class ReportTodayController extends Controller
{
    public function index()
    {
      $data['date'] = date('Y-m-d');
      $data['date_back'] = date('Y-m-d',strtotime("-1 day"));
      $data['goods'] = Good::getAll();
      $data['no'] = 1;

      return view('report.today.index',$data);
    }

    public function print()
    {
      $data['date'] = date('Y-m-d');
      $data['date_back'] = date('Y-m-d',strtotime("-1 day"));
      $data['goods'] = Good::getAll();
      $data['no'] = 1;

      return view('report.today.print',$data);
    }
}
