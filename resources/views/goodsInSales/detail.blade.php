@extends('layouts.index')

@section('title')
Detail Barang Masuk Dari Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Barang Masuk Dari Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/sales">Barang Masuk Dari Sales</a></li>
    <li class="active">Detail Barang Masuk Dari Sales</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      &nbsp;

      @if ($gs->status==2)
      <a href="/barang_masuk/sales/ubah/{{$gs->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
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
          <th>Tanggal</th>
          <th>:</th>
          <th>{{$gs->created_at}}</th>
        </tr>
        <tr>
          <th>Status</th>
          <th>:</th>
          <th>@if($gs->status==1)<label class="label label-warning">Barang Belum Kembali</label>@else<label class="label label-info">Barang Sudah Kembali</label>@endif</th>
        </tr>
        <tr>
          <th>Keterangan</th>
          <th>:</th>
          <th>{{$gs->description}}</th>
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
            <th rowspan="2" width="1%"><center>No</centero</th>
            <th rowspan="2"><center>Nama Barang</center></th>
            <th colspan="2"><center>Barang Keluar</center></th>
            <th colspan="2"><center>Barang Kembali</center></th>
            <th colspan="2"><center>Bad Stok</center></th>
            <th rowspan="2" width="18%"><center>Keterangan</center></th>
            <th rowspan="2" width="1%"></th>
          </tr>
          <tr>
            <th width="9%"><center>Jml (BOX)</center></th>
            <th width="9%"><center>Jml (PCS)</center></th>
            <th width="9%"><center>Jml (BOX)</center></th>
            <th width="9%"><center>Jml (PCS)</center></th>
            <th width="9%"><center>Jml (BOX)</center></th>
            <th width="9%"><center>Jml (PCS)</center></th>
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
            <td><center>{{$item->qyt_box_in}}</center></td>
            <td><center>{{$item->qyt_pcs_in}}</center></td>
            <td><center>{{$item->bad_stok_box}}</center></td>
            <td><center>{{$item->bad_stok_pcs}}</center></td>
            <td>{{$item->description}}</td>
            <td>
              @if ($gs->status==2)
              <a href="/barang_masuk/sales/detail/ubah/{{$item->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
              @endif
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
