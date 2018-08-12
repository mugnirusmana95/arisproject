@extends('layouts.index')

@section('title')
Tambah Return Barang Dari Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Return Barang Dari Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/retur/gudang">Return Barang Dari Gudang</a></li>
    <li class="active">Tambah Return Barang Dari Gudang</li>
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
      &nbsp;

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <form class="form-horizontal" method="post" action="{{route('gi.return.warehouse.store')}}">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('gos') ? 'has-error' : ''}}">
          <label for="gos" class="control-label col-md-2">ID Barang Keluar <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" id="gos" name="gos">
              <option value=""></option>
            </select>
            <p class="help-block">
              @if ($errors->has('gos'))
                {{$errors->first('gos')}}
              @endif
            </p>
          </div>
        </div>

        <div id="gosd_date" class="form-group @if(!$errors->has('date'))hide @endif {{$errors->has('date') ? 'has-error' : ''}}">
          <label for="date" class="control-label col-md-2">Tanggal <span class="req">*</span></label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="date" id="date" placeholder="Pilih Tanggal" readonly style="background-color:#FFF">
            <p class="help-block">
              @if ($errors->has('date'))
                {{$errors->first('date')}}
              @endif
            </p>
          </div>
        </div>

        <div id="gosd" class="form-group @if(!$errors->has('goods'))hide @endif {{$errors->has('goods') ? 'has-error' : ''}}">
          <label for="goods" class="control-label col-md-2">Barang <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control select2" id="goods" name="goods[]" multiple="multiple" data-placeholder="Pilih Barang" style="width: 100%;">
            </select>
            <p class="help-block">
              @if ($errors->has('goods'))
                {{$errors->first('goods')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('description2') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-10">
            <textarea id="description" name="description" class="form-control" rows="3" maxlength="255">{{old('description')}}</textarea>
            <p class="help-block">
              @if ($errors->has('description'))
                {{$errors->first('description')}}
              @endif
            </p>
          </div>
        </div>

      </div>
      <div class="box-footer">
        <div class="form-group">
          <label for="name" class="control-label col-md-2"></label>
          <div class="col-md-8">
            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
            <button type="reset" class="btn btn-md btn-default">Reset</button>
          </div>
        </div>
      </div>
    </form>
  </div>

</section>
@endsection

@section('js')
<script>
$(document).ready(function(){
  $("#gos").select2({
    placeholder: "Pilih ID",
    width: "100%",
    ajax: {
      url: '{{route('go.sales.getAllReturn')}}',
      dataType: 'json',
      data: function (params){
          return{
              q: $.trim(params.term),
          };
      },
      processResults: function (data){
          return{
              results: data
          };
      },
      cache: true
    }
  });

  $("#gos").change(function(){
    $("#goods").val(null);
    $("#date").val(null);

    var id_gos = null;
    id_gos = $(this).val();

    $.get('/barang_keluar/sales/cek/id/'+id_gos, function(res){
      var date = res.created_at;
      var date_split = date.split('-');
      var year = parseInt(date_split[0]);
      var month = parseInt(date_split[1]-1);
      var day_split = date_split[2].split(" ");
      var day = parseInt(day_split[0]);
      $("#date").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        startDate: new Date(year, month, day),
      });
    });

    $("#goods").select2({
      ajax: {
        url: '{{route('go.sales.detail.getGoodsReturn')}}',
        dataType: 'json',
        data: function (params){
          return{
            id: id_gos,
            q: $.trim(params.term),
          };
        },
        processResults: function (data){
          console.log(data);
          return{
            results: data
          };
        },
        cache: true
      }
    });

    $("#gosd").removeClass("hide");
    $("#gosd_date").removeClass("hide");

  });

});
</script>
@endsection
