@extends('layouts.index')

@section('title')
Tambah Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Cabang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/master/gudang">Cabang</a></li>
    <li class="active">Tambah Cabang</li>
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
    <form class="form-horizontal" method="post" action="/master/gudang/tambah/simpan">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Nama <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Cabang" value="{{old('name')}}">
            <p class="help-block">
              @if ($errors->has('name'))
                {{$errors->first('name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
          <label for="address" class="control-label col-md-2">Alamat</label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="address" id="address" placeholder="Masukan Alamat Cabang" value="{{old('address')}}" rows="3">{{old('address')}}</textarea>
            <p class="help-block">
              @if ($errors->has('address'))
                {{$errors->first('address')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
          <label for="phone" class="control-label col-md-2">Telpon</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukan Nomor Telepon" value="{{old('phone')}}">
            <p class="help-block">
              @if ($errors->has('phone'))
                {{$errors->first('phone')}}
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
