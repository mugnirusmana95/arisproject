@extends('layouts.index')

@section('title')
Laporan Barang Masuk Dari Cabang Tanggal {{$date}}
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tanggal {{$date}}
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('report.giware.index')}}">Laporan Barang Masuk Dari Cabang</a></li>
    <li class="active">Tanggal {{$date}}</li>
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
              <th colspan="2"><center>Bad Stocks</center></th>
              <th colspan="2"><center>Good Stocks</center></th>
            </tr>
            <tr>
              <th width="10%"><center>Box</center></th>
              <th width="10%"><center>Pcs</center></th>
              <th width="10%"><center>Box</center></th>
              <th width="10%"><center>Pcs</center></th>
              <th width="10%"><center>Box</center></th>
              <th width="10%"><center>Pcs</center></th>
            </tr>
          </thead>
          <tbody>
            @if (count($giware)==0)
            <tr>
              <td colspan="8">Data tidak ditemukan.</td>
            </tr>
            @else
              @foreach ($giware as $item)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$item->goods->name}}</td>
                  <td><center>@if($item->qyt_box == null){{0}}@else{{$item->qyt_box}}@endif</center></td>
                  <td><center>@if($item->qyt_pcs == null){{0}}@else{{$item->qyt_pcs}}@endif</center></td>
                  <td><center>@if($item->bad_stock_box==null){{0}}@else{{$item->bad_stock_box}}@endif</center></td>
                  <td><center>@if($item->bad_stock_pcs==null){{0}}@else{{$item->bad_stock_pcs}}@endif</center></td>
                  <td><center>@if($item->qyt_box - $item->bad_stock_box == null){{0}}@else{{$item->qyt_box - $item->bad_stock_box}}@endif</center></td>
                  <td><center>@if($item->qyt_pcs - $item->bad_stock_pcs == null){{0}}@else{{$item->qyt_pcs - $item->bad_stock_pcs}}@endif</center></td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="box-footer">
      @if (count($giware)>0)
      <form action="{{route('report.giware.printDate')}}" method="post" target="_blank">
        {{ csrf_field() }}
        <input type="hidden" name="tanggal" value="{{$date}}">
        <span class="pull-right" data-toggle="tooltip" title="Cetak Data (A4 Portrait)"><button type="submit" class="btn btn-md btn-info" name="button"><span class="fa fa-print"></span></button></span>
      </form>
      @else
      &nbsp;
      @endif
    </div>
  </div>

</section>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $("table").DataTable();
    });
  </script>
@endsection
