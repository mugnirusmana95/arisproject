@extends('layouts.index')

@section('title')
Detail Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Gudang</a></li>
    <li class="active">Detail Barang Keluar Ke Gudang</li>
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
      <a href="/barang_masuk/retur/gudang/detail/tambah/{{$rw->id}}" class="btn btn-md btn-info"><span class="fa fa-plus"></span></a>
      {{-- <a href="/barang_keluar/gudang/cetak/{{$rw->id}}" class="btn btn-md btn-success" target="_blank"><span class="fa fa-print"></span></a> --}}
      <a onclick="return confirm('Anda yakin ?')" href="/barang_masuk/retur/gudang/hapus/{{$rw->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>

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
          <th>{{$rw->id}}</th>
        </tr>
        <tr>
          <th>ID Barang Keluar</th>
          <th>:</th>
          <th>{{$rw->id_goods_out_warehouse}}&nbsp;<a href="/barang_keluar/gudang/lihat/{{$rw->id_goods_out_warehouse}}" data-toggle="tooltip" title="Lihat data barang keluar" target="_blank"><span class="fa fa-info-circle"></span></a></th>
        </tr>
        <tr>
          <th>Gudang</th>
          <th>:</th>
          <th>{{$rw->goodsOutWarehouse->warehouse->name}}</th>
        </tr>
        <tr>
          <th>Tanggal Retur</th>
          <th>:</th>
          <th>{{$rw->date}}</th>
        </tr>
        <tr>
          <th>Tanggal Input</th>
          <th>:</th>
          <th>{{$rw->created_at}}</th>
        </tr>
        <tr>
          <th>Keterangan</th>
          <th>:</th>
          <th><span data-toggle="tooltip" data-placement="top" title="Ubah keterangan"><a href="#" class="warning" data-toggle="modal"  data-target="#description"><span class="fa fa-edit"></span></a></span> {{$rw->description}}</th>
        </tr>
      </table>
    </div>
    <div class="box-footer">

      <form action="/barang_masuk/retur/gudang/edit_keterangan/simpan/{{$rw->id}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">

        <div class="modal fade" id="description">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 for="description" class="modal-title">Ubah Komentar</h4>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="description" id="description" rows="3">{{$rw->description}}</textarea>
                    </div>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>

  @if (count($rwd)>0)
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
            <th colspan="2"><center>Barang Retur</center></th>
            <th colspan="2"><center>Bad Stock</center></th>
            <th rowspan="2" width="25%"><center>Keterangan</center></th>
            <th rowspan="2" width="10%"></th>
          </tr>
          <tr>
            <th width="10%"><center>Jml (BOX)</center></th>
            <th width="10%"><center>Jml (PCS)</center></th>
            <th width="10%"><center>Jml (BOX)</center></th>
            <th width="10%"><center>Jml (PCS)</center></th>
          </tr>
        </thead>
        @php
          $no=1;
        @endphp
        <tbody>
          @foreach ($rwd as $item)
          <tr>
            <td><center>{{$no++}}</center></td>
            <td>{{$item->goods->name}}</td>
            <td><center>{{$item->qyt_box}}</center></td>
            <td><center>{{$item->qyt_pcs}}</center></td>
            <td><center>{{$item->bad_stock_box}}</center></td>
            <td><center>{{$item->bad_stock_pcs}}</center></td>
            <td>{{$item->description}}</td>
            <td>
              <center>
                <a href="/barang_keluar/retur/gudang/detail/ubah/{{$item->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
                <a onclick="return confirm('Anda yakin ?')" href="/barang_keluar/retur/gudang/detail/hapus/{{$item->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
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
