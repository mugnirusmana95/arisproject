@extends('layouts.index')

@section('title')
Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Sales</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/master/sales/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th width="15%"><center>ID</center></th>
              <th>Nama</th>
              <th width="20%">Nomor HP</th>
              <th width="20%"><center>Jenis Kelamin</center></th>
              <th width="13%"></th>
            </tr>
          </thead>
          <tbody>
            @if (count($sales)<=0)
            <tr>
              <td colspan="7">Tidak ada data. <a href="/master/sales/tambah">Tambah Data</a>.</td>
            </tr>
            @else
            @foreach ($sales as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$item->id}}</center></td>
              <td>{{$item->name}}</td>
              <td>{{$item->phone}}</td>
              <td><center>@if($item->gender==1){{"Laki-Laki"}}@else{{"Perempuan"}}@endif</center></td>
              <td>
                <center>
                  <a href="/master/sales/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a>
                  <a href="/master/sales/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                  <a href="/master/sales/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
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
