@extends('layouts.index')

@section('title')
Cabang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Cabang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Cabang</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/master/gudang/tambah" class="btn btn-md btn-primary">Tambah</a>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table id="table" class="table table-hovered table-bordered">
          <thead>
            <tr>
              <th width="1%"><center>No</center></th>
              <th width="1%"><center>ID</center></th>
              <th width="30%">Nama</th>
              <th>Alamat</th>
              <th width="20%"><center>Telepon</center></th>
              <th width="10%"></th>
            </tr>
          </thead>
          <tbody>
            @if (count($warehouse)<=0)
            <tr>
              <td colspan="5">Tidak ada data. <a href="/master/gudang/tambah">Tambah Data</a>.</td>
            </tr>
            @else
            @foreach ($warehouse as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td><center>{{$item->id}}</center></td>
              <td>{{$item->name}}</td>
              <td>{{$item->address}}</td>
              <td><center>{{$item->phone}}</center></td>
              <td>
                <center>
                  <a href="/master/gudang/ubah/{{$item->id}}" class="btn btn-md btn-primary"><span class="fa fa-edit"></span></a>
                  <a href="/master/gudang/hapus/{{$item->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
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
    $("#table").DataTable({
      "columnDefs": [
        { "orderable": false, "targets": 0},
        { "orderable": false, "targets": 5},
      ]
    });
  });
</script>
@endsection
