@extends('layouts.index')

@section('title')
Detail Barang Keluar Ke Cabang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Detail Barang Keluar Ke Cabang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Cabang</a></li>
    <li class="active">Detail Barang Keluar Ke Cabang</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <a href="/barang_keluar/gudang/detail/tambah/{{$gow->id}}" class="btn btn-md btn-info"><span class="fa fa-plus"></span></a>
      <a href="/barang_keluar/gudang/cetak/{{$gow->id}}" class="btn btn-md btn-success" target="_blank"><span class="fa fa-print"></span></a>
      @if (count($rw) < 1)
      <a href="/barang_keluar/gudang/ubah/{{$gow->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
      <a onclick="return confirm('Anda yakin ?')" href="/barang_keluar/gudang/hapus/{{$gow->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
      @endif

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
          <th>{{$gow->id}}</th>
        </tr>
        <tr>
          <th>Cabang</th>
          <th>:</th>
          <th>{{$gow->warehouse->name}}</th>
        </tr>
        <tr>
          <th>Tanggal Input</th>
          <th>:</th>
          <th>{{$gow->created_at}}</th>
        </tr>
        <tr>
          <th>Keterangan</th>
          <th>:</th>
          <th>{{$gow->description}}</th>
        </tr>
      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

  @if (count($gowd)>0)
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
          @foreach ($gowd as $item)
          <tr>
            <td><center>{{$no++}}</center></td>
            <td>{{$item->goods->name}}</td>
            <td><center>{{$item->qyt_box}}</center></td>
            <td><center>{{$item->qyt_pcs}}</center></td>
            <td>{{$item->description}}</td>
            <td>
              <center>
                @if(count(App\ReturnWarehouseDetail::getIdGoods($item->id_goods, $gow->id))<=0)
                  <a href="/barang_keluar/gudang/detail/ubah/{{$item->id}}" class="btn btn-md btn-warning"><span class="fa fa-edit"></span></a>
                  <a onclick="return confirm('Anda yakin ?')" href="/barang_keluar/gudang/detail/hapus/{{$item->id}}" class="btn btn-md btn-danger"><span class="fa fa-trash"></span></a>
                @endif
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
        { "orderable": false, "targets": 0},
        { "orderable": false, "targets": 5},
      ]
    });
  });
</script>
@endsection
