@extends('layouts.index')

@section('title')
Barang Keluar Oleh Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Barang Keluar Oleh Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Barang Keluar Oleh Sales</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/barang_keluar/sales/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th>Nama Sales</th>
              <th width="25%"><center>Tanggal</center></th>
              <th width="25%"><center>Status</center></th>
              <th width="15%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($gs)==0)
              <tr>
                <td colspan="4">Tidak ada data. <a href="/barang_keluar/sales/tambah">Tambah Data</a>.</td>
              </tr>
            @else
            @foreach ($gs as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td>{{$item->sales->name}}</td>
              <td><center>{{$item->created_at}}</center></td>
              <td><center>@if($item->status==1)<label class="label label-warning">Barang Belum Kembali</label>@else<label class="label label-info">Barang Sudah Kembali</label>@endif</center></td>
              <td>
                <center>
                  <a href="/barang_keluar/sales/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a>
                  <a href="/barang_keluar/sales/detail/tambah/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-plus"></span></a>
                  @if ($item->status==1)
                  <a href="/barang_keluar/sales/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                  <a href="/barang_keluar/sales/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                  @endif
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
