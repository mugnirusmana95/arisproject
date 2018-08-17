@extends('layouts.index')

@section('title')
Ubah Password
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Password
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/profile">Profile</a></li>
    <li class="active">Ubah Password</li>
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
    <form class="form-horizontal" method="post" action="/profile/ubah_password/simpan">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('old_password') ? 'has-error' : ''}}">
          <label for="old_password" class="control-label col-md-2">Password Lama <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Masukan Password Lama">
            <p class="help-block">
              @if ($errors->has('old_password'))
                {{$errors->first('old_password')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
          <label for="password" class="control-label col-md-2">Password Baru <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password Baru">
            <p class="help-block">
              @if ($errors->has('password'))
                {{$errors->first('password')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
          <label for="password_confirmation" class="control-label col-md-2">Ulangi Password Baru <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password Baru">
            <p class="help-block">
              @if ($errors->has('password_confirmation'))
                {{$errors->first('password_confirmation')}}
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
