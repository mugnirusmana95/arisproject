@extends('layouts.index')

@section('title')
Detail Barang Keluar Oleh Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Barang Keluar Oleh Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/barang_keluar/sales">Barang Keluar Oleh Sales</a></li>
    <li class="active">Detail Barang Keluar Oleh Sales</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/barang_keluar/sales/detail/tambah/{{$gs->id}}" class="btn btn-md btn-info"><span class="fa fa-plus"></span></a>
      {{-- <a href="/barang_keluar/sales/cetak/{{$gs->id}}" class="btn btn-md btn-success" target="_blank"><span class="fa fa-print"></span></a> --}}
      @if ($gs->status==1)
      <a href="/barang_keluar/sales/ubah/{{$gs->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
      <a href="/barang_keluar/sales/hapus/{{$gs->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
      @endif

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table">
        <tr>
          <th width="15%">ID</th>
          <th width="1%">:</th>
          <th>{{$gs->id}}</th>
        </tr>
        <tr>
          <th>Sales</th>
          <th>:</th>
          <th>{{$gs->sales->name}} <a href="/master/sales/lihat/{{$gs->id_sales}}" target="_blank"><span class="fa fa-info-circle" data-toggle="tooltip" title="Lihat Data"></span></a></th>
        </tr>
        <tr>
          <th>Keterangan</th>
          <th>:</th>
          <th>{{$gs->description}}</th>
        </tr>
        <tr>
          <th>Tanggal</th>
          <th>:</th>
          <th>{{$gs->created_at}}</th>
        </tr>
        <tr>
          <th>Status</th>
          <th>:</th>
          <th>@if($gs->status==1)<label class="label label-warning">Barang Belum Kembali</label>@else<label class="label label-info">Barang Sudah Kembali</label>@endif</th>
        </tr>
      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

  @if (count($gsd)>0)
  <div class="box box-default">
    <div class="box-header with-border">
      <h3>Detail Barang</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-hovered table-bordered">
        <thead>
          <tr>
            <th width="1%"><center>No</center></th>
            <th><center>Nama Barang</center></th>
            <th width="15%"><center>Jumlah (Box)</center></th>
            <th width="15%"><center>Jumlah (Pcs)</center></th>
            <th width="20%"><center>Keterangan</center></th>
            <th width="10%"></th>
          </tr>
        </thead>
        @php
          $no=1;
        @endphp
        <tbody>
          @foreach ($gsd as $item)
          <tr>
            <td><center>{{$no++}}</center></td>
            <td>{{$item->goods->name}}</td>
            <td><center>{{$item->qyt_box_out}}</center></td>
            <td><center>{{$item->qyt_pcs_out}}</center></td>
            <td>{{$item->description}}</td>
            <td>
              <center>
                @if ($gs->status==1)
                <a href="/barang_keluar/sales/detail/ubah/{{$item->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
                <a href="/barang_keluar/sales/detail/hapus/{{$item->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
                @endif
              </center>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif

</section>
@endsection
