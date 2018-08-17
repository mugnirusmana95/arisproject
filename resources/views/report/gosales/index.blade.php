@extends('layouts.index')

@section('title')
Laporan Barang Keluar Oleh Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Laporan Barang Keluar Oleh Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Laporan Barang Keluar Oleh Sales</li>
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
  @elseif(count($errors)>0)
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Danger!</h4>
    Data gagal disimpan.
  </div>
  @else
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-info"></i> Info!</h4>
    Field yang memiliki tanda (<span class="req">*</span>) tidak boleh kosong.
  </div>
  @endif

  <div class="box box-default">
    <div class="box-header with-border">
      <h4>Laporan Per Periode</h4>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <form class="form-horizontal" method="post" action="{{route('report.gosales.checkPeriode')}}">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group">

          <!-- /.input group -->
        </div>

        <div class="form-group {{$errors->has('periode') ? 'has-error' : ''}}">
          <label for="periode" class="control-label col-md-2">Masukan Tanggal <span class="req">*</span></label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="periode" id="periode" readonly style="background-color:#FFF">
            <p class="help-block">
              @if ($errors->has('periode'))
                {{$errors->first('periode')}}
              @endif
            </p>
          </div>
        </div>

      </div>
      <div class="box-footer">
        <div class="form-group">
          <label for="name" class="control-label col-md-2"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn-md btn-primary">Cari</button>
            <button type="reset" class="btn btn-md btn-default">Reset</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="box box-default">
    <div class="box-header with-border">
      <h4>Laporan Per Tanggal</h4>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <form class="form-horizontal" method="post" action="{{route('report.gosales.checkDate')}}">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group">

          <!-- /.input group -->
        </div>

        <div class="form-group {{$errors->has('tanggal') ? 'has-error' : ''}}">
          <label for="tanggal" class="control-label col-md-2">Masukan Tanggal <span class="req">*</span></label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="tanggal" id="tanggal" readonly style="background-color:#FFF">
            <p class="help-block">
              @if ($errors->has('tanggal'))
                {{$errors->first('tanggal')}}
              @endif
            </p>
          </div>
        </div>

      </div>
      <div class="box-footer">
        <div class="form-group">
          <label for="name" class="control-label col-md-2"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn-md btn-primary">Cari</button>
            <button type="reset" class="btn btn-md btn-default">Reset</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="box box-default">
    <div class="box-header with-border">
      <h4>Laporan Hari ini</h4>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <form class="form-horizontal" method="post" action="{{route('report.gosales.checkToday')}}">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group">

          <!-- /.input group -->
        </div>

        <div class="form-group {{$errors->has('tanggal') ? 'has-error' : ''}}">
          <label for="tanggal" class="control-label col-md-2">Hari ini <span class="req">*</span></label>
          <div class="col-md-9">
            <input type="text" class="form-control" name="tanggal" id="tanggal" readonly style="background-color:#FFF" value="{{'2018-08-13'}}">
            <p class="help-block">
              @if ($errors->has('tanggal'))
                {{$errors->first('tanggal')}}
              @endif
            </p>
          </div>
        </div>

      </div>
      <div class="box-footer">
        <div class="form-group">
          <label for="name" class="control-label col-md-2"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn-md btn-primary">Cari</button>
            <button type="reset" class="btn btn-md btn-default">Reset</button>
          </div>
        </div>
      </div>
    </form>
  </div>

</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $("#periode").daterangepicker({
      autoUpdateInput: false,
      }, function(start, end) {
      $("#periode").val(start.format('YYYY-MM-DD') + ' s/d ' + end.format('YYYY-MM-DD'));
    });

    $("#tanggal").datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
  });
</script>
@endsection
