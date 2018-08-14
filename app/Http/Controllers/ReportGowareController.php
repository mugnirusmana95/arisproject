<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsOutWarehouseDetail;

class ReportGowareController extends Controller
{
  public function index()
  {
    return view('report.goware.index');
  }

  public function checkData(Request $req)
  {
    $this->validate($req,[
      'periode' => 'required',
    ],[
      'periode.required' => 'Field wajib diisi',
    ]);

    $date = explode(" s/d ",$req->periode);
    $date_start = $date[0];
    $date_end = $date[1];

    $data['goware'] = GoodsOutWarehouseDetail::getRangeDate($date_start, $date_end);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['no'] = 1;

    return view('report.goware.get_data',$data);
  }

  public function printPeriode(Request $req)
  {
    $data['goware'] = GoodsOutWarehouseDetail::getRangeDate($req->date_start, $req->date_end);
    $data['date_start'] = $req->date_start;
    $data['date_end'] = $req->date_end;
    $data['no'] = 1;

    return view('report.goware.print_periode',$data);
  }
}
