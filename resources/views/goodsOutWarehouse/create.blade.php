@extends('layouts.index')

@section('title')
Tambah Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Gudang</a></li>
    <li class="active">Tambah Barang Keluar Ke Gudang</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      &nbsp;

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <form class="form-horizontal" method="post" action="/barang_keluar/gudang/tambah/simpan">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('warehouse') ? 'has-error' : ''}}">
          <label for="warehouse" class="control-label col-md-2">Gudang <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" id="warehouse" name="warehouse">
              <option value=""></option>
            </select>
            <p class="help-block">
              @if ($errors->has('warehouse'))
                {{$errors->first('warehouse')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
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
  $("#warehouse").select2({
    placeholder: "Pilih Gudang",
    width: "100%",
    ajax: {
      url: '{{route('warehouse.all')}}',
      dataType: 'json',
      data: function (params){
          return{
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

  $("#goods").select2({
    ajax: {
      url: '{{route('goods.allready')}}',
      dataType: 'json',
      data: function (params){
          return{
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
});
</script>
@endsection
