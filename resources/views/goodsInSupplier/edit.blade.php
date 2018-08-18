@extends('layouts.index')

@section('title')
Ubah Barang Masuk Dari Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Barang Masuk Dari Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/supplier">Barang Masuk Dari Supplier</a></li>
    <li class="active">Ubah Barang Masuk Dari Supplier</li>
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
    <form class="form-horizontal" method="post" action="/barang_masuk/supplier/ubah/simpan/{{$gis->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('supplier') ? 'has-error' : ''}}">
          <label for="supplier" class="control-label col-md-2">Supplier <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" name="supplier">
              <option value="">--Pilih Supplier--</option>
              @foreach ($supplier as $item)
              <option value="{{$item->id}}" @if($item->id==$gis->id_supplier)selected @endif>{{$item->name}}</option>
              @endforeach
            </select>
            <p class="help-block">
              @if ($errors->has('supplier'))
                {{$errors->first('supplier')}}
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
