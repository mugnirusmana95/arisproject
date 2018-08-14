<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSalesDetails;

class ReportGosalesController extends Controller
{
  public function index()
  {
    return view('report.gosales.index');
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

    $data['gosales'] = GoodsSalesDetails::getOutRangeDate($date_start, $date_end);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['no'] = 1;

    return view('report.gosales.get_data',$data);
  }

  public function printPeriode(Request $req)
  {
    $data['gosales'] = GoodsSalesDetails::getOutRangeDate($req->date_start, $req->date_end);
    $data['date_start'] = $req->date_start;
    $data['date_end'] = $req->date_end;
    $data['no'] = 1;

    return view('report.gosales.print_periode',$data);
  }
}
