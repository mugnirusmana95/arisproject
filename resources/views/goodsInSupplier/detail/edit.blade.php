@extends('layouts.index')

@section('title')
Ubah Detail Barang Masuk Dari Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Detail Barang Masuk Dari Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/supplier">Barang Masuk Dari Supplier</a></li>
    <li><a href="/barang_masuk/supplier/lihat/{{$gis->id}}">Detail Masuk Dari Supplier</a></li>
    <li class="active">Ubah Detail Barang Masuk Dari Supplier</li>
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
    <form class="form-horizontal" method="post" action="/barang_masuk/supplier/detail/ubah/simpan/{{$gisd->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('supplier') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Supplier <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="supplier" value="{{$gis->supplier->name}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Barang <span class="req">*</span></label>
          <div class="col-md-8">
            <select class="form-control" name="goods">
              <option value="">--Pilih Barang--</option>
              @foreach ($goods as $item)
              <option value="{{$item->id}}" @if($item->id==$gisd->id_goods)selected @endif>{{$item->name}}</option>
              @endforeach
            </select>
            <p class="help-block">
              @if ($errors->has('goods'))
                {{$errors->first('goods')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_box') ? 'has-error' : ''}}">
          <label for="qyt_box" class="control-label col-md-2">Jumlah (Box)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="qyt_box" value="@if(count($errors)>0){{old('qyt_box')}}@else{{$gisd->qyt_box}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_box'))
                {{$errors->first('qyt_box')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_pcs') ? 'has-error' : ''}}">
          <label for="qyt_pcs" class="control-label col-md-2">Jumlah (Pcs)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="qyt_pcs" value="@if(count($errors)>0){{old('qyt_pcs')}}@else{{$gisd->qyt_pcs}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_pcs'))
                {{$errors->first('qyt_pcs')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="description" rows="5">@if(count($errors)>0){{old('description')}}@else{{$gisd->description}}@endif</textarea>
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
