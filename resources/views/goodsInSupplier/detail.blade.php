@extends('layouts.index')

@section('title')
Detail Barang Masuk Dari Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Barang Masuk Dari Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/supplier">Barang Masuk Dari Supplier</a></li>
    <li class="active">Detail Barang Masuk Dari Supplier</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <span data-toggle="tooltip" title="Tambah Barang"><a href="/barang_masuk/supplier/detail/tambah/{{$gis->id}}" class="btn btn-md btn-info"><span class="fa fa-plus"></span></a></span>
      <span data-toggle="tooltip" title="Ubah Data"><a href="/barang_masuk/supplier/ubah/{{$gis->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a></span>
      <span data-toggle="tooltip" title="Hapus Data"><a onclick="return confirm('Anda Yakin ?')" href="/barang_masuk/supplier/hapus/{{$gis->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a></span>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table">
        <tr>
          <th width="15%">ID</th>
          <th width="1%">:</th>
          <th>{{$gis->id}}</th>
        </tr>
        <tr>
          <th>Supplier</th>
          <th>:</th>
          <th>{{$gis->supplier->name}}</th>
        </tr>
        <tr>
          <th>Tanggal</th>
          <th>:</th>
          <th>{{$gis->created_at}}</th>
        </tr>
      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

  @if (count($gisd)>0)
  <div class="box box-default">
    <div class="box-header with-border">
      <h3>Detail Barang</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="table" class="table table-hovered table-bordered">
        <thead>
          <tr>
            <th width="1%"><center>No</center></th>
            <th><center>Nama Barang</center></th>
            <th width="15%"><center>Jumlah (Box)</center></th>
            <th width="15%"><center>Jumlah (Pcs)</center></th>
            <th width="20%"><center>Keterangan</center></th>
            <th width="10%"></th>
          </tr>
        </thead>
        @php
          $no=1;
        @endphp
        <tbody>
          @foreach ($gisd as $item)
          <tr>
            <td><center>{{$no++}}</center></td>
            <td>{{$item->goods->name}}</td>
            <td><center>{{$item->qyt_box}}</center></td>
            <td><center>{{$item->qyt_pcs}}</center></td>
            <td>{{$item->description}}</td>
            <td>
              <center>
                <span data-toggle="tooltip" title="Ubah Data"><a href="/barang_masuk/supplier/detail/ubah/{{$item->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a></span>
                <span data-toggle="tooltip" title="Hapus Data"><a onclick="return confirm('Anda Yakin ?')" href="/barang_masuk/supplier/detail/hapus/{{$item->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a></span>
              </center>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif

</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $("#table").DataTable({
      "columnDefs": [
        {"orderable": false, "targets": 0},
        {"orderable": false, "targets": 5}
      ]
    });
  });
</script>
@endsection
