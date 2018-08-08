@extends('layouts.index')

@section('title')
Barang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Barang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Barang</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/master/barang/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th rowspan="2" width="10%"><center>ID</center></th>
              <th rowspan="2"><center>Nama</center></th>
              <th colspan="2"><center>Good Stock</center></th>
              <th colspan="2"><center>Bad Stock</center></th>
              <th rowspan="2" width="10%"><center>Jumlah</center></th>
              <th rowspan="2" width="10%"><center>Jumlah</center></th>
              <th rowspan="2" width="10%"><center>Jumlah Barang Per Box</center></th>
              <th rowspan="2" width="10%"><center>Total</center></th>
              <th rowspan="2" width="10%"></th>
            </tr>
            <tr>
              <th width="5%"><center>Box</center></th>
              <th width="5%"><center>Pcs</center></th>
              <th width="5%"><center>Box</center></th>
              <th width="5%"><center>Pcs</center></th>
            </tr>
          </thead>
          <tbody>
            @if (count($good)<=0)
            <tr>
              <td colspan="7">Tidak ada data. <a href="/master/barang/tambah">Tambah Data</a>.</td>
            </tr>
            @else
            @foreach ($good as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$item->id}}</center></td>
              <td>{{$item->name}}</td>
              <td><center>{{$item->qyt_box-$item->bad_stock_box}}</center></td>
              <td><center>{{$item->qyt_pcs-$item->bad_stock_pcs}}</center></td>
              <td><center>@if($item->bad_stock_box==null){{0}}@else{{$item->bad_stock_box}}@endif</center></td>
              <td><center>@if($item->bad_stock_pcs==null){{0}}@else{{$item->bad_stock_pcs}}@endif</center></td>
              <td><center>@if($item->qyt_box==null){{0}}@else{{$item->qyt_box}}@endif Box</center></td>
              <td><center>@if($item->qyt_pcs==null){{0}}@else{{$item->qyt_pcs}}@endif Pcs</center></td>
              <td><center>{{$item->pcs_per_box}} Pcs</center></td>
              <td><center>{{($item->qyt_box * $item->pcs_per_box) + $item->qyt_pcs}} Pcs</center></td>
              <td>
                <center>
                  <a href="/master/barang/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                  <a href="/master/barang/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
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
