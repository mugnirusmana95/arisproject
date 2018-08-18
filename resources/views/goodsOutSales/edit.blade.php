@extends('layouts.index')

@section('title')
Tambah Barang Keluar Oleh Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Keluar Oleh Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_keluar/sales">Barang Keluar Oleh Sales</a></li>
    <li class="active">Tambah Barang Keluar Oleh Sales</li>
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
    <form class="form-horizontal" method="post" action="/barang_keluar/sales/ubah/simpan/{{$gs->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('sales') ? 'has-error' : ''}}">
          <label for="sales" class="control-label col-md-2">Sales <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" id="sales" name="sales">
              <option value="{{$gs->id_sales}}">{{$gs->sales->name}}</option>
            </select>
            <p class="help-block">
              @if ($errors->has('sales'))
                {{$errors->first('sales')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('description2') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-10">
            <textarea id="description" name="description" class="form-control" rows="3" maxlength="255">@if(count($errors)>0){{old('description')}}@else{{$gs->description}}@endif</textarea>
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
  $("#sales").select2({
    placeholder: "{{$gs->sales->name}}",
    width: "100%",
    ajax: {
      url: '{{route('sales.all')}}',
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
