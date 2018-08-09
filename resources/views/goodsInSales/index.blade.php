@extends('layouts.index')

@section('title')
Barang Masuk Dari Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Barang Masuk Dari Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Barang Masuk Dari Sales</li>
  </ol>
</section>

<section class="content">

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
              <th width="1%"><center>No</center></th>
              <th width="1%"><center>ID</center></th>
              <th>Nama Sales</th>
              <th width="20%"><center>Tanggal</center></th>
              <th width="20%"><center>Status</center></th>
              <th width="9%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($gs)==0)
              <tr>
                <td colspan="6">Tidak ada data. <a href="/barang_masuk/sales/tambah">Tambah Data</a>.</td>
              </tr>
            @else
            @foreach ($gs as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td></center>{{$item->id}}</center></td>
              <td>{{$item->sales->name}}</td>
              <td><center>{{$item->created_at}}</center></td>
              <td><center>@if($item->status==1)<label class="label label-warning">Barang Belum Kembali</label>@else<label class="label label-info">Barang Sudah Kembali</label>@endif</center></td>
              <td>
                @if ($item->status==2)
                <a href="/barang_masuk/sales/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a>
                <a href="/barang_masuk/sales/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                @else
                <a href="/barang_masuk/sales/kembali/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-check"></span></a>
                @endif
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
