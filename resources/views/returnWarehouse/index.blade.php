@extends('layouts.index')

@section('title')
Return Barang Dari Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Return Barang Dari Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Return Barang Dari Gudang</li>
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
      <a href="/barang_masuk/retur/gudang/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th><center>ID</center></th>
              <th><center>ID Barang Keluar</center></th>
              <th><center>Nama Gudang</center></th>
              <th width="15%"><center>Tanggal</center></th>
              <th width="12%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($rw)==0)
              <tr>
                <td colspan="6">Tidak ada data. <a href="/barang_masuk/retur/gudang/tambah">Tambah Data</a>.</td>
              </tr>
            @else
            @foreach ($rw as $item)
              <tr>
                <td><center>{{$no++}}</center></td>
                <td><center>{{$item->id}}</center></td>
                <td><center>{{$item->id_goods_out_warehouse}}</center></td>
                <td><center>{{$item->goodsOutWarehouse->warehouse->name}}</center></td>
                <td><center>{{$item->date}}</center></td>
                <td>
                  <span data-toggle="tooltip" title="Lihat Data"><a href="/barang_masuk/retur/gudang/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a></span>
                  <span data-toggle="tooltip" title="Tambah Barang"><a href="/barang_masuk/retur/gudang/detail/tambah/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-plus"></span></a></span>
                  <span data-toggle="tooltip" title="Hapus Data"><a onclick="return confirm('Anda yakin ?')" href="/barang_masuk/retur/gudang/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a></span>
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
  $("#table").DataTable({
    "columnDefs": [
      {'orderable': false, 'targets': 0},
      {'orderable': false, 'targets': 5},
    ]
  });
</script>
@endsection
