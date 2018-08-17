@extends('layouts.index2')

@section('title')
  Lupa Password
@endsection

@section('main')
  <div class="login-box">
    <div class="login-logo">
      <b>Lupa Password</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"></p>

      <form class="form-horizontal" method="post" action="{{ route('forgot.cekEmail') }}">
        {{ csrf_field() }}

        <div class="col-md-12">
          <div class="form-group has-feedback @if($errors->has('email'))has-error @endif @if(Session::has('warning'))has-error @endif">
            <label for="email">Masukan Email</label>
            <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
              <p class="help-block">
                {{$errors->first('email')}}
              </p>
            @endif
            @if (Session::has('warning'))
              <p class="help-block">
                {{Session::get('warning')}}
              </p>
            @endif
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Cari</button>
          </div>
        </div>

      </form>

      Code akan dikirim ke email anda
      <br>

    </div>
  </div>
@endsection
