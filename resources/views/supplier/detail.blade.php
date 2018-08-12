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
    <li><a href="/master/supplier">Supplier</a></li>
    <li class="active">Detail Supplier</li>
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
      <a href="/master/supplier/ubah/{{$supplier->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
      <a onclick="return confirm('anda yakin ?')" href="/master/supplier/hapus/{{$supplier->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>

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
          <td width="30%">{{$supplier->id}}</td>
          <td width="1%" rowspan="6"><b>Logo</b></td>
          <td width="1%" rowspan="6"><b>:</b></td>
          <td rowspan="6">
            <center>
              @if ($supplier->logo == null || $supplier->logo=="")
                <img src="{{asset('images/supplier/null.png')}}" height="220px" alt="">
              @else
                <img src="{{asset('images/supplier/'.$supplier->id.'/'.$supplier->logo)}}" height="220px" alt="">
              @endif
            </center>
          </td>
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
