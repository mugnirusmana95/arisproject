@extends('layouts.index')

@section('title')
Detail Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/sales">Sales</a></li>
    <li class="active">Detail Sales</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/master/sales/ubah/{{$sales->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
      <a href="/master/sales/hapus/{{$sales->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table">
        <tr>
          <td width="15%"><strong>ID Sales</strong></td>
          <td width="1%">:</td>
          <td>{{$sales->id}}</td>
        </tr>
        <tr>
          <td><strong>Nama</strong></td>
          <td>:</td>
          <td>{{$sales->name}}</td>
        </tr>
        <tr>
          <td><strong>Jenis Kelamin</strong></td>
          <td>:</td>
          <td>
            @if($sales->gender==1)
              Laki-Laki
            @else
              Perempuan
            @endif
          </td>
        </tr>
        <tr>
          <td><strong>Nomor HP</strong></td>
          <td>:</td>
          <td>{{$sales->phone}}</td>
        </tr>
        <tr>
          <td><strong>Email</strong></td>
          <td>:</td>
          <td>{{$sales->email}}</td>
        </tr>
        <tr>
          <td><strong>Alamat</strong></td>
          <td>:</td>
          <td>{{$sales->address}}</td>
        </tr>
      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

</section>
@endsection
