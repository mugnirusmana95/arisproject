@extends('layouts.index')

@section('title')
Ubah Barang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Barang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/barang">Barang</a></li>
    <li class="active">Ubah Barang</li>
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
    <form class="form-horizontal" method="post" action="/master/barang/ubah/simpan/{{$good->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Nama <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="name" placeholder="Masukan Nama Barang" value="@if(count($errors)>0){{old('name')}}@else{{$good->name}}@endif">
            <p class="help-block">
              @if ($errors->has('name'))
                {{$errors->first('name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_box') ? 'has-error' : ''}}">
          <label for="qyt_box" class="control-label col-md-2">Jumlah (Box)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="qyt_box" placeholder="Masukan Jumlah Barang Per Box" value="@if(count($errors)>0){{old('qyt_box')}}@else{{$good->qyt_box}}@endif">
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
            <input type="text" class="form-control" name="qyt_pcs" placeholder="Masukan Jumlah Barang Per Pcs" value="@if(count($errors)>0){{old('qyt_pcs')}}@else{{$good->qyt_pcs}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_pcs'))
                {{$errors->first('qyt_pcs')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('pcs_per_box') ? 'has-error' : ''}}">
          <label for="pcs_per_box" class="control-label col-md-2">Jumlah Per Box <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="pcs_per_box" placeholder="Masukan Jumlah Barang Per Box" value="@if(count($errors)>0){{old('pcs_per_box')}}@else{{$good->pcs_per_box}}@endif">
            <p class="help-block">
              @if ($errors->has('pcs_per_box'))
                {{$errors->first('pcs_per_box')}}
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
