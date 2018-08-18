@extends('layouts.index')

@section('title')
Barang Masuk Dari Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Barang Masuk Dari Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Barang Masuk Dari Sales</li>
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
      &nbsp;

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
              <th>Nama Sales</th>
              <th width="20%"><center>Tanggal</center></th>
              <th width="20%"><center>Status</center></th>
              <th width="12%"></th>
            </tr>
          </thead>
          @php
            $no=1;
          @endphp
          <tbody>
            @if (count($gs)==0)
              <tr>
                <td colspan="6">Tidak ada data.</td>
              </tr>
            @else
            @foreach ($gs as $item)
            <tr>
              <td><center>{{$no++}}</center></td>
              <td></center>{{$item->id}}</center></td>
              <td>{{$item->sales->name}}</td>
              <td><center>{{$item->created_at}}</center></td>
              <td><center>@if($item->status==1)<label class="label label-warning">Barang Belum Kembali</label>@else<label class="label label-info">Barang Sudah Kembali</label>@endif</center></td>
              <td>
                @if ($item->status==2)
                <span data-toggle="tooltip" title="Lihat Data"><a href="/barang_masuk/sales/lihat/{{$item->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a></span>
                <span data-toggle="tooltip" title="Ubah Data"><a href="/barang_masuk/sales/ubah/{{$item->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a></span>
                <span data-toggle="tooltip" title="Hapus Data"><a onclick="return confirm('Anda yakin ? \nMenghapus data tersebut, dapat menghapus barang keluar dari sales');" href="/barang_masuk/sales/hapus/{{$item->id}}" class="btn btn-sm btn-danger"><span class="fa fa-edit"></span></a></span>
                @else
                <span data-toggle="tooltip" title="Kontifmasi Barang Kembali"><a onclick="return confirm('Konfirmasi barang kembali ?');" href="/barang_masuk/sales/kembali/{{$item->id}}" class="btn btn-sm btn-info"><span class="fa fa-check"></span></a></span>
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
  $("#table").DataTable({
    "columnDefs": [
      {"orderable": false, "targets": 0},
      {"orderable": false, "targets": 5},
    ]
  });
</script>
@endsection
