@extends('layouts.index2')

@section('title')
Password Baru
@endsection

@section('main')
  <div class="login-box">
    <div class="login-logo">
      <b>Ubah Password</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"></p>

      <form class="form-horizontal" method="post" action="/lupa_password/ubah_password/simpan/{{$email}}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">

        <div class="col-md-12">
          <div class="form-group has-feedback @if($errors->has('email'))has-error @endif">
            <label for="password">Email</label>
            <input type="text" id="email" class="form-control" name="email" placeholder="Email" readonly style="background-color:#FFF" value="{{$email}}">
            @if ($errors->has('password'))
              <p class="help-block">
                {{$errors->first('email')}}
              </p>
            @endif
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group has-feedback @if($errors->has('password'))has-error @endif">
            <label for="password">Password Baru</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password Baru">
            @if ($errors->has('password'))
              <p class="help-block">
                {{$errors->first('password')}}
              </p>
            @endif
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group has-feedback @if($errors->has('password_confirmation'))has-error @endif">
            <label for="password_confirmation">Ulangi Password Baru</label>
            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Ulangi Password Baru">
            @if ($errors->has('password_confirmation'))
              <p class="help-block">
                {{$errors->first('password_confirmation')}}
              </p>
            @endif
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
          </div>
        </div>

      </form>

      Pastikan password anda aman<br>
      <br>

    </div>
  </div>
@endsection
