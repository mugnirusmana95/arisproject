@extends('layouts.index')

@section('title')
Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Barang Keluar Ke Gudang</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">

      <a href="/barang_keluar/gudang/tambah" class="btn btn-md btn-primary">Tambah</a>

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
              <th><center>Nama Gudang</center></th>
              <th width="15%"><center>Tanggal</center></th>
              <th width="18%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($gow)==0)
              <tr>
                <td colspan="4">Tidak ada data. <a href="/barang_keluar/gudang/tambah">Tambah Data</a>.</td>
              </tr>
            @else
            @foreach ($gow as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td>{{$item->warehouse->name}}</td>
              <td><center>{{$item->created_at}}</center></td>
              <td>
                <a href="/barang_keluar/gudang/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a>
                <a href="/barang_keluar/gudang/detail/tambah/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-plus"></span></a>
                {{-- <a href="/barang_keluar/gudang/cetak/{{$item->id}}" class="btn btn-sm btn-success" target="_blank"><span class="fa fa-print"></span></a> --}}
                @if(count(App\ReturnWarehouse::getIdGoodsOutWarehouse($item->id))<=0)
                <a href="/barang_keluar/gudang/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                <a href="/barang_keluar/gudang/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                @endif
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
    $('#table').DataTable();
  });
</script>
@endsection
