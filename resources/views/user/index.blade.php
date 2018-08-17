@extends('layouts.index')

@section('title')
User
@endsection

@section('main')
<section class="content-header">
  <h1>
    User
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">User</li>
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
      <a href="/master/user/tambah" class="btn btn-md btn-primary">Tambah</a>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="user" class="table table-hovered table-bordered">
          <thead>
            <tr>
              <th width="1%"><center>No</center></th>
              <th width="1%"><center>ID</center></th>
              <th>Nama</th>
              <th width="20%"><center>Email</center></th>
              <th width="10%"><center>Hak Akses</center></th>
              <th width="16%"></th>
            </tr>
          </thead>
          <tbody>
            @if (count($user)<=0)
            <tr>
              <td colspan="7">Tidak ada data. <a href="/master/user/tambah">Tambah Data</a>.</td>
            </tr>
            @else
            @foreach ($user as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$item->id}}</center></td>
              <td>{{$item->first_name}} {{$item->last_name}}</td>
              <td>{{$item->email}}</td>
              <td>
                <center>
                @if ($item->status == 1)
                  <label class="label label-danger">Adminstrator</label>
                @else
                  <label class="label label-info">User</label>
                @endif
                </center>
              </td>
              <td>
                <center>
                  <span data-toggle="tooltip" title="Lihat Data"><a href="/master/user/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a></span>
                  <span data-toggle="tooltip" title="Ubah Hak Akses"><a href="/master/user/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a></span>
                  <span data-toggle="tooltip" title="Reset Password"><a onclick="return confirm('Anda yakin ?')" href="/master/user/reset/{{$item->id}}" class="btn btn-sm btn-success"><span class="fa fa-key"></span></a></span>
                  <span data-toggle="tooltip" title="Hapus Data"><a onclick="return confirm('Anda yakin ?')" href="/master/user/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a></span>
                </center>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="box-footer">
    </div>
  </div>

</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $("#user").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0},
        { "orderable": false, "targets": 5},
      ]
    });
  });
</script>
@endsection
