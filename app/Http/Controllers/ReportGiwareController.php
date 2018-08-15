<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsInWarehouseDetail;

class ReportGiwareController extends Controller
{
  public function index()
  {
    $data['today'] = date('Y-m-d');

    return view('report.giware.index', $data);
  }

  public function checkPeriode(Request $req)
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

    return view('report.giware.get_periode',$data);
  }

  public function printPeriode(Request $req)
  {
    $data['giware'] = GoodsInWarehouseDetail::getRangeDate($req->date_start, $req->date_end);
    $data['date_start'] = $req->date_start;
    $data['date_end'] = $req->date_end;
    $data['no'] = 1;

    return view('report.giware.print_periode',$data);
  }

  public function checkDate(Request $req)
  {
    $this->validate($req,[
      'tanggal' => 'required',
    ],[
      'tanggal.required' => 'Field wajib diisi',
    ]);

    $data['giware'] = GoodsInWarehouseDetail::getDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.giware.get_date',$data);
  }

  public function printDate(Request $req)
  {
    $data['giware'] = GoodsInWarehouseDetail::getDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.giware.print_date',$data);
  }

  public function checkToday(Request $req)
  {
    $data['giware'] = GoodsInWarehouseDetail::getDate($req->sekarang);
    $data['date'] = $req->sekarang;
    $data['no'] = 1;

    return view('report.giware.get_today',$data);
  }

  public function printToday(Request $req)
  {
    $data['giware'] = GoodsInWarehouseDetail::getDate($req->sekarang);
    $data['date'] = $req->sekarang;
    $data['no'] = 1;

    return view('report.giware.print_today',$data);
  }
}
