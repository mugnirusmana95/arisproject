@extends('layouts.index')

@section('title')
Tambah Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/sales">Sales</a></li>
    <li class="active">Tambah Sales</li>
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
    <form class="form-horizontal" method="post" action="/master/sales/tambah/simpan">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Nama <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Sales" value="{{old('name')}}">
            <p class="help-block">
              @if ($errors->has('name'))
                {{$errors->first('name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('gender') ? 'has-error' : ''}}">
          <label for="gender" class="control-label col-md-2">Jenis Kelamin <span class="req">*</span></label>
          <div class="col-md-8">
            <div class="radio">
              <label>
                <input type="radio" name="gender" id="gender" value="1">
                Laki-Laki
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="gender" id="gender2" value="2">
                Perempuan
              </label>
            </div>
            <p class="help-block">
              @if ($errors->has('gender'))
                {{$errors->first('gender')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
          <label for="phone" class="control-label col-md-2">Nomor HP</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukan Nomor HP" value="{{old('phone')}}">
            <p class="help-block">
              @if ($errors->has('phone'))
                {{$errors->first('phone')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
          <label for="email" class="control-label col-md-2">Email</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Nomor Email" value="{{old('email')}}">
            <p class="help-block">
              @if ($errors->has('email'))
                {{$errors->first('email')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
          <label for="address" class="control-label col-md-2">Alamat</label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" id="address" name="address" placeholder="Masukan Alamat" rows="4">{{old('address')}}</textarea>
            <p class="help-block">
              @if ($errors->has('address'))
                {{$errors->first('address')}}
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
