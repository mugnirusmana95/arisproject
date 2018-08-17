@extends('layouts.index')

@section('title')
Tambah User
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah User
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/master/user">User</a></li>
    <li class="active">Tambah User</li>
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
    <form class="form-horizontal" method="post" action="/master/user/tambah/simpan">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
          <label for="first_name" class="control-label col-md-2">Nama Depan <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="firt_name" name="first_name" placeholder="Masukan Nama Depa" value="{{old('first_name')}}">
            <p class="help-block">
              @if ($errors->has('first_name'))
                {{$errors->first('first_name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
          <label for="last_name" class="control-label col-md-2">Nama Belakang</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Masukan Nama Belakang" value="{{old('last_name')}}">
            <p class="help-block">
              @if ($errors->has('last_name'))
                {{$errors->first('last_name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
          <label for="email" class="control-label col-md-2">Email <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email" value="{{old('email')}}">
            <p class="help-block">
              @if ($errors->has('email'))
                {{$errors->first('email')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
          <label for="telp" class="control-label col-md-2">Hak akses <span class="req">*</span></label>
          <div class="col-md-8">
            <select class="form-control" id="status" name="status">
              <option value="">Pilih Hak Akses</option>
              <option value="1">Administrator</option>
              <option value="2">User</option>
            </select>
            <p class="help-block">
              @if ($errors->has('status'))
                {{$errors->first('status')}}
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
