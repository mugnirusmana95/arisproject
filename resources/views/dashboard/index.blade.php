@extends('layouts.index')

@section('title')
Dashboard
@endsection

@section('main')
<section class="content-header">
  <h1>
    Dashboard
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
</section>

<section class="content">

  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>Selamat Datang!</h4>
    Nama.
  </div>

  @if (count($gos)>0)
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Barang keluar oleh sales yang belum kembali</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table">
        <thead>
          <tr>
            <th><center>No</center></th>
            <th><center>ID</center></th>
            <th>Nama Sales</th>
            <th><center>Tanggal</center></th>
            <th><center>Status</center></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($gow as $item_gos)
          <tr>
            <td>{{$no_sales}}</td>
            <td><center>{{$item_gos->id}}</center></td>
            <td><center>{{$item_gos->sales->name}}</center></td>
            <td><center>{{$item_gos->date}}</center></td>
            <td><center><label class="label label-warning">Barang Belum Kembali</label></center></td>
            <td>
              <span data-toggle="tooltip" title="Lihat Data"><a href="/barang_keluar/sales/lihat/{{$item_gos->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a><span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      &nbsp;
    </div>
  </div>
  @endif

</section>
@endsection
