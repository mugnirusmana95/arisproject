<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GoodsSales;
use App\User;
use App\GoodsInSupplierDetail;
use App\GoodsInWarehouseDetail;
use App\GoodsSalesDetails;
use App\ReturnWarehouseDetail;
use App\GoodsOutWarehouseDetail;
use Auth;
use Hash;

class DashboardController extends Controller
{
    public function index()
    {
      $id = Auth::user()->id;
      $out = 1;
      $data['check_password'] = Hash::check('bersamamandiri',Auth::user()->password);
      $data['user'] = User::getId($id);
      $data['today'] = date('Y-m-d');
      $data['year'] = date('Y');
      $data['gos'] = GoodsSales::getStatus($out);
      $data['no_sales'] = 1;


      $gisup_year = GoodsInSupplierDetail::getGoodsYear($data['year']);
      $giware_year = GoodsInWarehouseDetail::getGoodsYear($data['year']);
      $gisales_year = GoodsSalesDetails::getInGoodsYear($data['year']);
      $giretun_year = ReturnWarehouseDetail::getGoodsYear($data['year']);
      $giware_out_year = GoodsOutWarehouseDetail::getGoodsYear($data['year']);
      $gisales_out_year = GoodsSalesDetails::getOutGoodsYear($data['year']);

      $data['total_in_box_year'] = 0 + $gisup_year->qyt_box + $giware_year->qyt_box + $gisales_year->qyt_box + $giretun_year->qyt_box;
      $data['total_in_pcs_year'] = 0 + $gisup_year->qyt_pcs + $giware_year->qyt_pcs + $gisales_year->qyt_pcs + $giretun_year->qyt_pcs;
      $data['total_out_box_year'] = 0 + $giware_out_year->qyt_box + $gisales_out_year->qyt_box;
      $data['total_out_pcs_year'] = 0 + $giware_out_year->qyt_pcs + $gisales_out_year->qyt_pcs;

      $gisup_in = GoodsInSupplierDetail::getAllGoodsYear($data['today']);
      $giware_in = GoodsInWarehouseDetail::getAllGoodsYear($data['today']);
      $gisales_in = GoodsSalesDetails::getInAllGoodsYear($data['today']);
      $giretun_in = ReturnWarehouseDetail::getAllGoodsYear($data['today']);

      $data['total_in_box'] = 0 + $gisup_in->qyt_box + $giware_in->qyt_box + $gisales_in->qyt_box + $giretun_in->qyt_box;
      $data['total_in_pcs'] = 0 + $gisup_in->qyt_pcs + $giware_in->qyt_pcs + $gisales_in->qyt_pcs + $giretun_in->qyt_pcs;

      $giware_out = GoodsOutWarehouseDetail::getAllGoodsYear($data['today']);
      $gisales_out = GoodsSalesDetails::getOutAllGoodsYear($data['today']);

      $data['total_out_box'] = 0 + $giware_out->qyt_box + $gisales_out->qyt_box;
      $data['total_out_pcs'] = 0 + $giware_out->qyt_pcs + $gisales_out->qyt_pcs;

      return view('dashboard.index',$data);
    }
}
