<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsOutWarehouseDetail;

class ReportGowareController extends Controller
{
  public function index()
  {
    $data['date'] = date('Y-m-d');

    return view('report.goware.index',$data);
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

    $data['goware'] = GoodsOutWarehouseDetail::getRangeDate($date_start, $date_end);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['no'] = 1;

    return view('report.goware.get_periode',$data);
  }

  public function printPeriode(Request $req)
  {
    $data['goware'] = GoodsOutWarehouseDetail::getRangeDate($req->date_start, $req->date_end);
    $data['date_start'] = $req->date_start;
    $data['date_end'] = $req->date_end;
    $data['no'] = 1;

    return view('report.goware.print_periode',$data);
  }

  public function checkDate(Request $req)
  {
    $this->validate($req,[
      'tanggal' => 'required',
    ],[
      'tanggal.required' => 'Field wajib diisi',
    ]);

    $data['goware'] = GoodsOutWarehouseDetail::getDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.goware.get_date', $data);
  }

  public function printDate(Request $req)
  {
    $data['goware'] = GoodsOutWarehouseDetail::getDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.goware.print_date', $data);
  }

  public function checkToday(Request $req)
  {
    $data['goware'] = GoodsOutWarehouseDetail::getDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.goware.get_today',$data);
  }

  public function getToday(Request $req)
  {
    $data['goware'] = GoodsOutWarehouseDetail::getDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.goware.print_today',$data);
  }
}
