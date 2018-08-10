@extends('layouts.index')

@section('title')
Tambah Barang Keluar Oleh Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Keluar Oleh Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/barang_keluar/sales">Barang Keluar Oleh Sales</a></li>
    <li class="active">Tambah Barang Keluar Oleh Sales</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      &nbsp;

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <form class="form-horizontal" method="post" action="/barang_masuk/retur/gudang/detail/tambah/simpan/{{$rw->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="post">

      <div class="box-body">

        <div class="form-group {{$errors->has('sales') ? 'has-error' : ''}}">
          <label for="sales" class="control-label col-md-2">Barang</label>
          <div class="col-md-10">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th rowspan="2" width="1%"><center>No</center></th>
                  <th rowspan="2"><center>Nama Barang</center></th>
                  <th colspan="2"><center>Jumlah Retur</center></th>
                  <th colspan="2"><center>Bad Stock</center></th>
                  <th rowspan="2" width="25%"><center>Keterangan</center></th>
                </tr>
                <tr>
                  <th width="10%"><center>Jml (BOX)</center></th>
                  <th width="10%"><center>Jml (PCS)</center></th>
                  <th width="10%"><center>Jml (BOX)</center></th>
                  <th width="10%"><center>Jml (PCS)</center></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rwd as $item)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$item->goods->name}}</td>
                  <td><center>{{$item->qyt_box}}</center></td>
                  <td><center>{{$item->qyt_pcs}}</center></td>
                  <td><center>{{$item->bad_stock_box}}</center></td>
                  <td><center>{{$item->bad_stock_pcs}}</center></td>
                  <td>{{$item->description}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
          <label for="goods" class="control-label col-md-2">Barang Baru <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control select2" id="goods" name="goods[]" multiple="multiple" data-placeholder="Pilih Barang" style="width: 100%;">
            </select>
            <p class="help-block">
              @if ($errors->has('goods'))
                {{$errors->first('goods')}}
              @endif
            </p>
          </div>
        </div>

      </div>
      <div class="box-footer">
        <div class="form-group">
          <label for="name" class="control-label col-md-2"></label>
          <div class="col-md-8">
            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
            <button type="reset" class="btn btn-md btn-default">Reset</button>
          </div>
        </div>
      </div>
    </form>
  </div>

</section>
@endsection

@section('js')
<script>
$(document).ready(function(){
  var id_gow = "{{$rw->id_goods_out_warehouse}}";

  $("#goods").select2({
    ajax: {
      url: '{{route('go.warehouse.detail.getGoodsReturn')}}',
      dataType: 'json',
      data: function (params){
          return{
              id: id_gow,
              q: $.trim(params.term),
          };
      },
      processResults: function (data){
        console.log(data);
          return{
              results: data
          };
      },
      cache: true
    }
  });
});
</script>
@endsection
