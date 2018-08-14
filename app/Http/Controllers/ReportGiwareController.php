<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsInWarehouseDetail;

class ReportGiwareController extends Controller
{
  public function index()
  {
    return view('report.giware.index');
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

    $data['giware'] = GoodsInWarehouseDetail::getRangeDate($date_start, $date_end);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['no'] = 1;

    return view('report.giware.get_data',$data);
  }

  public function printPeriode(Request $req)
  {
    $data['giware'] = GoodsInWarehouseDetail::getRangeDate($req->date_start, $req->date_end);
    $data['date_start'] = $req->date_start;
    $data['date_end'] = $req->date_end;
    $data['no'] = 1;

    return view('report.giware.print_periode',$data);
  }
}
