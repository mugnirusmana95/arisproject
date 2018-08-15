@extends('layouts.index')

@section('title')
Laporan Hari Ini {{$date}}
@endsection

@section('main')
<section class="content-header">
  <h1>
    Laporan Hari Ini {{$date}}
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Laporan Hari Ini {{$date}}</li>
  </ol>
</section>

<section class="content">

  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Success!</h4>
    {{Session::get('success')}}.
  </div>
  @elseif(Session::has('warning'))
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> Warning!</h4>
    {{Session::get('warning')}}.
  </div>
  @endif

  <div class="box box-default">
    <div class="box-header with-border">
      &nbsp;

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-hovered table-bordered">
          <thead>
            <tr>
              <th rowspan="2" width="1%"><center>No</center></th>
              <th colspan="2"><center>Nama Barang</center></th>
              <th colspan="2"><center>Stok Awal<br>{{$date_back}}</center></th>
              <th colspan="2"><center>Barang Masuk</center></th>
              <th colspan="2"><center>Barang Keluar</center></th>
              <th colspan="2"><center>Stok Akhir<br>{{$date}}</center></th>
              <th colspan="2"><center>Stok Fisik</center></th>
              <th colspan="2"><center>Selisih</center></th>
            </tr>
            <tr>
              <th width="1%"><center>KD</center></th>
              <th width="10%"><center>Nama</center></th>
              <th width="1%"><center>Box</center></th>
              <th width="1%"><center>Pcs</center></th>
              <th width="1%"><center>Box</center></th>
              <th width="1%"><center>Pcs</center></th>
              <th width="1%"><center>Box</center></th>
              <th width="1%"><center>Pcs</center></th>
              <th width="1%"><center>Box</center></th>
              <th width="1%"><center>Pcs</center></th>
              <th width="1%"><center>Box</center></th>
              <th width="1%"><center>Pcs</center></th>
              <th width="1%"><center>Box</center></th>
              <th width="1%"><center>Pcs</center></th>
            </tr>
          </thead>
          <tbody>
            @if (count($goods)==0)
            <tr>
              <td colspan="8">Data tidak ditemukan.</td>
            </tr>
            @else
              @foreach ($goods as $item)

                @php
                  //Stock Awal
                  $qyt_awal_sup = App\GoodsInSupplierDetail::getGoodsDateBack($item->id, $date_back);
                  $qyt_awal_ware = App\GoodsInWarehouseDetail::getGoodsDateBack($item->id, $date_back);
                  $qyt_awal_sales = App\GoodsSalesDetails::getInGoodsDateBack($item->id, $date_back);
                  $qyt_awal_retur = App\ReturnWarehouseDetail::getGoodsDateBack($item->id, $date_back);

                  if(count($qyt_awal_sup)==0) {
                    $qyt_awal_sup_box = 0;
                    $qyt_awal_sup_pcs = 0;
                  } else {
                    $qyt_awal_sup_box = $qyt_awal_sup->qyt_box;
                    $qyt_awal_sup_pcs = $qyt_awal_sup->qyt_pcs;
                  }

                  if(count($qyt_awal_ware)==0) {
                    $qyt_awal_ware_box = 0;
                    $qyt_awal_ware_pcs = 0;
                  } else {
                    $qyt_awal_ware_box = $qyt_awal_ware->qyt_box;
                    $qyt_awal_ware_pcs = $qyt_awal_ware->qyt_pcs;
                  }

                  if (count($qyt_awal_sales)==0) {
                    $qyt_awal_sales_box = 0;
                    $qyt_awal_sales_pcs = 0;
                  } else {
                    $qyt_awal_sales_box = $qyt_awal_sales->qyt_box;
                    $qyt_awal_sales_pcs = $qyt_awal_sales->qyt_pcs;
                  }

                  if (count($qyt_awal_retur)==0) {
                    $qyt_awal_retur_box = 0;
                    $qyt_awal_retur_pcs = 0;
                  } else {
                    $qyt_awal_retur_box = $qyt_awal_retur->qyt_box;
                    $qyt_awal_retur_pcs = $qyt_awal_retur->qyt_pcs;
                  }

                  $total_awal_box = $qyt_awal_sup_box + $qyt_awal_ware_box + $qyt_awal_sales_box + $qyt_awal_retur_box;
                  $total_awal_pcs = $qyt_awal_sup_pcs + $qyt_awal_ware_pcs + $qyt_awal_sales_pcs + $qyt_awal_retur_pcs;

                  //Barang Masuk
                  $qyt_masuk_sup = App\GoodsInSupplierDetail::getGoodsDate($item->id, $date);
                  $qyt_masuk_ware = App\GoodsInWarehouseDetail::getGoodsDate($item->id, $date);
                  $qyt_masuk_sales = App\GoodsSalesDetails::getInGoodsDate($item->id, $date);
                  $qyt_masuk_retur = App\ReturnWarehouseDetail::getGoodsDate($item->id, $date);

                  if (count($qyt_masuk_sup)==0) {
                    $qyt_masuk_sup_box = 0;
                    $qyt_masuk_sup_pcs = 0;
                  } else {
                    $qyt_masuk_sup_box = $qyt_masuk_sup->qyt_box;
                    $qyt_masuk_sup_pcs = $qyt_masuk_sup->qyt_pcs;
                  }

                  if (count($qyt_masuk_ware)==0) {
                    $qyt_masuk_ware_box = 0;
                    $qyt_masuk_ware_pcs = 0;
                  } else {
                    $qyt_masuk_ware_box = $qyt_masuk_ware->qyt_box;
                    $qyt_masuk_ware_pcs = $qyt_masuk_ware->qyt_pcs;
                  }

                  if (count($qyt_masuk_sales)==0) {
                    $qyt_masuk_sales_box = 0;
                    $qyt_masuk_sales_pcs = 0;
                  } else {
                    $qyt_masuk_sales_box = $qyt_masuk_sales->qyt_box;
                    $qyt_masuk_sales_pcs = $qyt_masuk_sales->qyt_pcs;
                  }

                  if (count($qyt_masuk_retur)==0) {
                    $qyt_masuk_retur_box = 0;
                    $qyt_masuk_retur_pcs = 0;
                  } else {
                    $qyt_masuk_retur_box = $qyt_masuk_retur->qyt_box;
                    $qyt_masuk_retur_pcs = $qyt_masuk_retur->qyt_pcs;
                  }

                  $total_masuk_box = $qyt_masuk_sup_box + $qyt_masuk_ware_box + $qyt_masuk_sales_box + $qyt_masuk_retur_box;
                  $total_masuk_pcs = $qyt_masuk_sup_pcs + $qyt_masuk_ware_pcs + $qyt_masuk_sales_pcs + $qyt_masuk_retur_pcs;

                  //Barang Keluar
                  $qyt_keluar_ware = App\GoodsOutWarehouseDetail::getGoodsDate($item->id, $date);
                  $qyt_keluar_sales = App\GoodsSalesDetails::getOutGoodsDate($item->id, $date);


                  if (count($qyt_keluar_ware)==0) {
                    $qyt_keluar_ware_box = 0;
                    $qyt_keluar_ware_pcs = 0;
                  } else {
                    $qyt_keluar_ware_box = $qyt_keluar_ware->qyt_box;
                    $qyt_keluar_ware_pcs = $qyt_keluar_ware->qyt_pcs;
                  }

                  if (count($qyt_keluar_sales)==0) {
                    $qyt_keluar_sales_box = 0;
                    $qyt_keluar_sales_pcs = 0;
                  } else {
                    $qyt_keluar_sales_box = $qyt_keluar_sales->qyt_box;
                    $qyt_keluar_sales_pcs = $qyt_keluar_sales->qyt_pcs;
                  }

                  $total_keluar_box = $qyt_keluar_ware_box + $qyt_keluar_sales_box;
                  $total_keluar_pcs = $qyt_keluar_ware_pcs + $qyt_keluar_sales_pcs;

                  //Total Stok Awal ((Stock Gudang + Barang Masuk[today-1 day]) - Barang Masuk[today])
                  $total_awal_box2 = ($item->qyt_box + $total_awal_box)-$total_masuk_box;
                  $total_awal_pcs2 = ($item->qyt_pcs + $total_awal_pcs)-$total_masuk_pcs;
                @endphp

                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$item->id}}<center></td>
                  <td>{{$item->name}}</td>
                  <td>
                    <center>
                      {{$total_awal_box2}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_awal_pcs2}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_masuk_box}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_masuk_pcs}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_keluar_box}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_keluar_pcs}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{($total_awal_box2 + $total_masuk_box)-$total_keluar_box}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{($total_awal_pcs + $total_masuk_pcs)-$total_keluar_pcs}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_awal_box2 + ($total_masuk_box-$total_keluar_box)}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{$total_awal_pcs + ($total_masuk_pcs-$total_keluar_pcs)}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{(($total_awal_box2 + $total_masuk_box)-$total_keluar_box) - ($total_awal_box2 + ($total_masuk_box-$total_keluar_box))}}
                    </center>
                  </td>
                  <td>
                    <center>
                      {{(($total_awal_pcs2 + $total_masuk_pcs)-$total_keluar_pcs) - ($total_awal_pcs2 + ($total_masuk_pcs-$total_keluar_pcs))}}
                    </center>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="box-footer">
      @if (count($goods)>0)
        <span class="pull-right" data-toggle="tooltip" title="Cetak Data (A4 Portrait)"><a href="{{route('report.today.print')}}" class="btn btn-md btn-info" target="_blank"><span class="fa fa-print"></span></a></span>
      @else
      &nbsp;
      @endif
    </div>
  </div>

</section>
@endsection
