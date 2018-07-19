@extends('layouts.index')

@section('title')
Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Gudang</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/master/gudang/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th width="30%">Nama</th>
              <th>Alamat</th>
              <th width="10%"></th>
            </tr>
          </thead>
          <tbody>
            @if (count($warehouse)<=0)
            <tr>
              <td colspan="4">Tidak ada data. <a href="/master/gudang/tambah">Tambah Data</a>.</td>
            </tr>
            @else
            @foreach ($warehouse as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td>{{$item->name}}</td>
              <td>{{$item->address}}</td>
              <td>
                <center>
                  <a href="/master/gudang/ubah/{{$item->id}}" class="btn btn-md btn-primary"><span class="fa fa-edit"></span></a>
                  <a href="/master/gudang/hapus/{{$item->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
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
