@extends('layouts.index')

@section('title')
Barang Masuk Dari Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Barang Masuk Dari Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Barang Masuk Dari Supplier</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/barang_masuk/supplier/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th><center>Nama Supplier</center></th>
              <th width="15%"><center>Tanggal</center></th>
              <th width="15%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($gis)==0)
              <tr>
                <td colspan="4">Tidak ada data. <a href="/barang_masuk/supplier/tambah">Tambah Data</a>.</td>
              </tr>
            @else
            @foreach ($gis as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td>{{$item->supplier->name}}</td>
              <td><center>{{$item->created_at}}</center></td>
              <td>
                <center>
                  <a href="/barang_masuk/supplier/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a>
                  <a href="/barang_masuk/supplier/detail/tambah/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-plus"></span></a>
                  <a href="/barang_masuk/supplier/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                  <a href="/barang_masuk/supplier/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
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
    </div>
  </div>

</section>
@endsection
