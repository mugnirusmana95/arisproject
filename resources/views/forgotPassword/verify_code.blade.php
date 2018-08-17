@extends('layouts.index2')

@section('title')
Verifikasi Password
@endsection

@section('main')
  <div class="login-box">
    <div class="login-logo">
      <b>Verifikasi Kode</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">
        @if (Session::has('success'))
          {{Session::get('success')}}
        @endif
      </p>

      <form class="form-horizontal" method="post" action="/lupa_password/verifikasi_kode/cek/{{$email}}">
        {{ csrf_field() }}

        <div class="col-md-12">
          <div class="form-group has-feedback @if($errors->has('code'))has-error @endif @if(Session::has('warning'))has-error @endif">
            <label for="email">Verifikasi Kode</label>
            <input type="text" id="code" class="form-control" name="code" placeholder="Kode">
            @if ($errors->has('code'))
              <p class="help-block">
                {{$errors->first('code')}}
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

      Code telah dikirim ke email {{$email}}<br>
      <a href="/lupa_password/kirim_ulang_kode/{{$email}}">Kirim ulang kode</a>
      <br>

    </div>
  </div>
@endsection
