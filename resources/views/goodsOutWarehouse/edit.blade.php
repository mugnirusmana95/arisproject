@extends('layouts.index')

@section('title')
Ubah Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Gudang</a></li>
    <li class="active">Ubah Barang Keluar Ke Gudang</li>
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
    <form class="form-horizontal" method="post" action="/barang_keluar/gudang/ubah/simpan/{{$gow->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('warehouse') ? 'has-error' : ''}}">
          <label for="warehouse" class="control-label col-md-2">Gudang <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" id="warehouse" name="warehouse">
              <option value="{{$gow->id_warehouse}}">{{$gow->warehouse->name}}</option>
            </select>
            <p class="help-block">
              @if ($errors->has('warehouse'))
                {{$errors->first('warehouse')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-10">
            <textarea name="description" class="form-control" id="description" rows="3">@if(count($errors)>0){{old('description')}}@else{{$gow->description}}@endif</textarea>
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
<script type="text/javascript">
$(document).ready(function(){
  $("#warehouse").select2({
    placeholder: "{{$gow->warehouse->name}}",
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
});
</script>
@endsection
