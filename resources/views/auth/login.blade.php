@extends('layouts.index2')

@section('title')
  Login
@endsection

@section('main')
<div class="login-box">
  <div class="login-logo">
    <b>Inventory</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
      @if (Session::has('success'))
        {{Session::get('success')}}
      @endif
    </p>

    <form class="form-horizontal" method="post" action="{{ route('login') }}">
      {{ csrf_field() }}

      <div class="col-md-12">
        <div class="form-group has-feedback @if($errors->has('email'))has-error @endif">
          <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group has-feedback @if($errors->has('password'))has-error @endif">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
      </div>

      @if (count($errors)>0)
      <div class="col-md-12">
        <div class="form-group has-error">
          <p class="help-block">
            @foreach ($errors->all() as $error)
              {{$error}}<br>
            @endforeach
          </p>
        </div>
      </div>
      @endif

      <div class="col-md-12">
        <div class="form-group has-feedback">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>

    </form>

    <a href="/lupa_password">Lupa Password</a><br>

  </div>
</div>
@endsection
