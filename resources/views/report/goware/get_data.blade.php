@extends('layouts.index')

@section('title')
Laporan Barang Keluar Ke Gudang Dari {{$date_start}} s/d {{$date_end}}
@endsection

@section('main')
<section class="content-header">
  <h1>
    Dari {{$date_start}} s/d {{$date_end}}
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('report.gisup.index')}}">Laporan Barang Keluar Ke Gudang</a></li>
    <li class="active">Dari {{$date_start}} s/d {{$date_end}}</li>
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
              <th rowspan="2" width="1%"><center>No</center></th>
              <th rowspan="2"><center>Nama Barang</center></th>
              <th colspan="2"><center>Jumlah</center></th>
            </tr>
            <tr>
              <th width="20%"><center>Box</center></th>
              <th width="20%"><center>Pcs</center></th>
            </tr>
          </thead>
          <tbody>
            @if (count($goware)==0)
            <tr>
              <td colspan="8">Data tidak ditemukan.</td>
            </tr>
            @else
              @foreach ($goware as $item)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$item->goods->name}}</td>
                  <td><center>@if($item->qyt_box == null){{0}}@else{{$item->qyt_box}}@endif</center></td>
                  <td><center>@if($item->qyt_pcs == null){{0}}@else{{$item->qyt_pcs}}@endif</center></td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="box-footer">
      @if (count($goware)>0)
      <form action="{{route('report.goware.printPeriode')}}" method="post" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="date_start" value="{{$date_start}}">
        <input type="hidden" name="date_end" value="{{$date_end}}">
        <span class="pull-right" data-toggle="tooltip" title="Cetak Data (A4 Portrait)"><button type="submit" class="btn btn-md btn-info" name="button"><span class="fa fa-print"></span></button></span>
      </form>
      @else
      &nbsp;
      @endif
    </div>
  </div>

</section>
@endsection
