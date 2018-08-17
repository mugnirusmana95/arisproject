@extends('layouts.index')

@section('title')
Profile
@endsection

@section('main')
<section class="content-header">
  <h1>
    Profile
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Profile</li>
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
  @endif


  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
          @if ($user->picture==null)
            @if ($user->gender==1)
              <img class="profile-user-img img-responsive img-square" src="{{asset('images/profile/null_male.png')}}" alt="User profile picture">
            @elseif ($user->gender==2)
              <img class="profile-user-img img-responsive img-square" src="{{asset('images/profile/null_female.png')}}" alt="User profile picture">
            @else
              <img class="profile-user-img img-responsive img-square" src="{{asset('images/profile/null.png')}}" alt="User profile picture">
            @endif
          @else
            <img class="profile-user-img img-responsive img-square" src="{{asset('images/profile/'.$user->id.'/'.$user->picture)}}" alt="User profile picture">
          @endif

          <h3 class="profile-username text-center">{{$user->first_name}}</h3>

          <p class="text-muted text-center">
            @if ($user->status==1)
              Administrator
            @else
              User
            @endif
          </p>

          <a href="/profile/ubah_foto" class="btn btn-warning btn-block"><b>Ubah Foto Profile</b></a>
          <a href="/profile/ubah_password" class="btn btn-danger btn-block"><b>Ubah Password</b></a>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header">
          <h4>Data Diri</h4>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="20%">ID</td>
              <td width="1%">:</td>
              <td>{{$user->id}}</td>
            </tr>
            <tr>
              <td>Nama Lengkap</td>
              <td>:</td>
              <td>{{$user->first_name}} {{$user->last_name}}</td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>:</td>
              <td>
                @if ($user->gender==1)
                  Laki-Laki
                @elseif($user->gender==2)
                  Perempuan
                @endif
              </td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>{{$user->email}}</td>
            </tr>
            <tr>
              <td>Telpon</td>
              <td>:</td>
              <td>{{$user->phone}}</td>
            </tr>
            <tr>
              <td>Tempat, Tanggal Lahir</td>
              <td>:</td>
              <td>
                @if ($user->pbo!=null || $user->pob!="")
                  {{$user->pob}},
                @endif
                {{$user->dob}}
              </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>{{$user->address}}</td>
            </tr>
          </table>
        </div>
        <div class="box-footer">
        <span data-toggle="tooltip" title="Ubah Data Diri"><a href="/profile/ubah_data" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a></span>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
