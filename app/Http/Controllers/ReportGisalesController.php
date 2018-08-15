<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSalesDetails;

class ReportGisalesController extends Controller
{
  public function index()
  {
    $data['today'] = date('Y-m-d');

    return view('report.gisales.index', $data);
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

    $data['gisales'] = GoodsSalesDetails::getInRangeDate($date_start, $date_end);
    $data['date_start'] = $date_start;
    $data['date_end'] = $date_end;
    $data['no'] = 1;

    return view('report.gisales.get_periode',$data);
  }

  public function printPeriode(Request $req)
  {

    $data['gisales'] = GoodsSalesDetails::getInRangeDate($req->date_start, $req->date_end);
    $data['date_start'] = $req->date_start;
    $data['date_end'] = $req->date_end;
    $data['no'] = 1;
    return view('report.gisales.print_periode',$data);
  }

  public function checkDate(Request $req)
  {
    $this->validate($req,[
      'tanggal' => 'required',
    ],[
      'tanggal.required' => 'Field wajib diisi',
    ]);

    $data['gisales'] = GoodsSalesDetails::getInDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.gisales.get_date',$data);
  }

  public function printDate(Request $req)
  {
    $data['gisales'] = GoodsSalesDetails::getInDate($req->tanggal);
    $data['date'] = $req->tanggal;
    $data['no'] = 1;

    return view('report.gisales.print_date',$data);
  }

  public function checkToday(Request $req)
  {
    $data['gisales'] = GoodsSalesDetails::getInDate($req->sekarang);
    $data['date'] = $req->sekarang;
    $data['no'] = 1;

    return view('report.gisales.get_today',$data);
  }

  public function printToday(Request $req)
  {
    $data['gisales'] = GoodsSalesDetails::getInDate($req->sekarang);
    $data['date'] = $req->sekarang;
    $data['no'] = 1;

    return view('report.gisales.print_today',$data);
  }
}
