@extends('layouts.index2')

@section('title')
404 Not Found
@endsection

@section('main')
  <div class="login-box">
    <div class="login-logo">
      <b>&nbsp;</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

      <h3><i class="fa fa-warning text-yellow"></i> Oops! Not found.</h3>
      <br><br>
      <p>
        Link tidak ditemuka.<br>
        jika ini adalah masalah silahkan hubungu admin.
      </p>
      <br>
      <a href="/" class="btn btn-md btn-block btn-primary">Kembali ke dashboard</a>
      <br>

    </div>
  </div>
@endsection
