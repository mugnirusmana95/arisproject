@extends('layouts.index')

@section('title')
Detail User
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail User
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/master/user">User</a></li>
    <li class="active">Detail User</li>
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

  <div class="box box-default">
    <div class="box-header with-border">
      <span data-toggle="tooltip" title="Ubah Hak Akses"><a href="/master/user/ubah/{{$user->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a></span>
      <span data-toggle="tooltip" title="Reset Password"><a onclick="return confirm('Anda yakin ?')" href="/master/user/reset/{{$user->id}}" class="btn btn-sm btn-success"><span class="fa fa-key"></span></a></span>
      <span data-toggle="tooltip" title="Hapus Data"><a onclick="return confirm('Anda yakin ?')" href="/master/user/hapus/{{$user->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a></span>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <td width="15%"><strong>ID User</strong></td>
            <td width="1%">:</td>
            <td width="30%">
              {{$user->id}}
              @if ($user->status == 1)
                <label class="label label-danger">Adminstrator</label>
              @else
                <label class="label label-info">User</label>
              @endif
            </td>
            <td width="1%" rowspan="6"><b>Foto</b></td>
            <td width="1%" rowspan="6"><b>:</b></td>
            <td rowspan="7">
              <center>
                @if ($user->picture == null || $user->picture=="")
                  @if ($user->gender==1)
                    <img src="{{asset('images/profile/null_male.png')}}" height="250px" alt="">
                  @elseif($user->gender==2)
                    <img src="{{asset('images/profile/null_female.png')}}" height="250px" alt="">
                  @else
                    <img src="{{asset('images/profile/null.png')}}" height="250px" alt="">
                  @endif
                @else
                  <img src="{{asset('images/profile/'.$user->id.'/'.$user->picture)}}" height="200px" alt="">
                @endif
              </center>
            </td>
          </tr>
          <tr>
            <td><strong>Nama</strong></td>
            <td>:</td>
            <td>{{$user->first_name}} {{$user->last_name}}</td>
          </tr>
          <tr>
            <td><strong>Jenis Kelamin</strong></td>
            <td>:</td>
            <td>
              @if($user->gender==1)
                Laki-Laki
              @elseif($user->gender==2)
                Perempuan
              @endif
            </td>
          </tr>
          <tr>
            <td><strong>Tempat, Tanggal Lahir</strong></td>
            <td>:</td>
            <td>@if($user->pob!=null){{$user->pob}},@endif {{$user->dob}}</td>
          </tr>
          <tr>
            <td><strong>Nomor HP</strong></td>
            <td>:</td>
            <td>{{$user->phone}}</td>
          </tr>
          <tr>
            <td><strong>Email</strong></td>
            <td>:</td>
            <td>{{$user->email}}</td>
          </tr>
          <tr>
            <td><strong>Alamat</strong></td>
            <td>:</td>
            <td>{{$user->address}}</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="box-footer">

    </div>
  </div>

</section>
@endsection
