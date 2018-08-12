@extends('layouts.index')

@section('title')
Return Barang Dari Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Return Barang Dari Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Return Barang Dari Sales</li>
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
      <a href="/barang_masuk/retur/sales/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th width="1%"><center>No</center></th>
              <th><center>ID</center></th>
              <th><center>ID Barang Keluar</center></th>
              <th><center>Nama Sales</center></th>
              <th width="15%"><center>Tanggal</center></th>
              <th width="12%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($rs)==0)
              <tr>
                <td colspan="6">Tidak ada data. <a href="/barang_masuk/retur/sales/tambah">Tambah Data</a>.</td>
              </tr>
            @else
            @foreach ($rs as $item)
              <tr>
                <td><center>{{$no++}}</center></td>
                <td><center>{{$item->id}}</center></td>
                <td><center>{{$item->id_goods_out_sales}}</center></td>
                <td><center>{{$item->goodsOutSales->sales->name}}</center></td>
                <td><center>{{$item->date}}</center></td>
                <td>
                  <a href="/barang_masuk/retur/sales/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a>
                  <a href="/barang_masuk/retur/sales/detail/tambah/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-plus"></span></a>
                  <a href="/barang_masuk/retur/sales/detail/tambah/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-plus"></span></a>
                  <a onclick="return confirm('Anda yakin ?')" href="/barang_masuk/retur/sales/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                </td>
              </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="box-footer">
    </div>
  </div>

</section>
@endsection
