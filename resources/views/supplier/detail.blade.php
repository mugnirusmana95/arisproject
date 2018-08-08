@extends('layouts.index')

@section('title')
Detail Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/supplier">Supplier</a></li>
    <li class="active">Detail Supplier</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/master/supplier/ubah/{{$supplier->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
      <a href="/master/supplier/hapus/{{$supplier->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table">
        <tr>
          <td width="15%"><strong>ID Supplier</strong></td>
          <td width="1%">:</td>
          <td>{{$supplier->id}}</td>
        </tr>
        <tr>
          <td><strong>Nama</strong></td>
          <td>:</td>
          <td>{{$supplier->name}}</td>
        </tr>
        <tr>
          <td><strong>Handphone</strong></td>
          <td>:</td>
          <td>{{$supplier->phone}}</td>
        </tr>
        <tr>
          <td><strong>Telphone</strong></td>
          <td>:</td>
          <td>{{$supplier->telp}}</td>
        </tr>
        <tr>
          <td><strong>Fax</strong></td>
          <td>:</td>
          <td>{{$supplier->fax}}</td>
        </tr>
        <tr>
          <td><strong>Email</strong></td>
          <td>:</td>
          <td>{{$supplier->email}}</td>
        </tr>
        <tr>
          <td><strong>Alamat</strong></td>
          <td>:</td>
          <td>{{$supplier->address}}</td>
        </tr>
      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

</section>
@endsection
