@extends('layouts.index')

@section('title')
Ubah Data Diri
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Data Diri
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/profile">Profile</a></li>
    <li class="active">Ubah Data Diri</li>
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
    <form class="form-horizontal" method="post" action="/profile/ubah_data/simpan">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
          <label for="first_name" class="control-label col-md-2">Nama Depan <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Masukan Nama Depan" value="@if(count($errors)>0){{old('first_name')}}@else{{$user->first_name}}@endif">
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
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Masukan Nama Belakang" value="@if(count($errors)>0){{old('last_name')}}@else{{$user->last_name}}@endif">
            <p class="help-block">
              @if ($errors->has('last_name'))
                {{$errors->first('last_name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('gender') ? 'has-error' : ''}}">
          <label for="gender" class="control-label col-md-2">Jenis Kelamin</label>
          <div class="col-md-8">
            <div class="radio">
              <label>
                <input type="radio" name="gender" id="gender" value="1" @if($user->gender==1)checked @endif>
                Laki-Laki
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="gender" id="gender2" value="2" @if($user->gender==2)checked @endif>
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

        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
          <label for="email" class="control-label col-md-2">Email <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email" value="@if(count($errors)>0){{old('email')}}@else{{$user->email}}@endif">
            <p class="help-block">
              @if ($errors->has('email'))
                {{$errors->first('email')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
          <label for="phone" class="control-label col-md-2">Telepon</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukan Nomor Telepon" value="@if(count($errors)>0){{old('phone')}}@else{{$user->phone}}@endif">
            <p class="help-block">
              @if ($errors->has('phone'))
                {{$errors->first('phone')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('place') ? 'has-error' : ''}}">
          <label for="place" class="control-label col-md-2">Tempat Lahir</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="place" name="place" placeholder="Masukan Tempat Lahir" value="@if(count($errors)>0){{old('place')}}@else{{$user->pob}}@endif">
            <p class="help-block">
              @if ($errors->has('place'))
                {{$errors->first('place')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
          <label for="date" class="control-label col-md-2">Tanggal Lahir</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="date" name="date" placeholder="Masukan Tanggal Lahir" value="@if(count($errors)>0){{old('date')}}@else{{$user->dob}}@endif" style="background-color:#FFF" readonly>
            <p class="help-block">
              @if ($errors->has('date'))
                {{$errors->first('date')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
          <label for="address" class="control-label col-md-2">Alamat</label>
          <div class="col-md-8">
            <textarea class="form-control" id="address" name="address" placeholder="Masukan Alamat" rows="3">@if(count($errors)>0){{old('date')}}@else{{$user->dob}}@endif</textarea>
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

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $("#date").datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
  });
</script>
@endsection
