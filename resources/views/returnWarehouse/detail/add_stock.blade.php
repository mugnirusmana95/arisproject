@extends('layouts.index')

@section('title')
Tambah Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Gudang</a></li>
    <li class="active">Tambah Barang Keluar Ke Gudang</li>
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
  @elseif(count($errors)>0)
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Danger!</h4>
    Data gagal disimpan.
  </div>
  @else
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-info"></i> Info!</h4>
    Field yang memiliki tanda (<span class="req">*</span>) tidak boleh kosong.
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
    <form class="form-horizontal" method="post" action="/barang_masuk/retur/gudang/detail/tambah/stok/simpan/{{$rw->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group">
          <label for="gow" class="control-label col-md-2">ID Barang Keluar</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="gow" value="{{$rw->id_goods_out_warehouse}}" readonly>
            <input type="hidden" class="form-control" name="id" value="{{$rw->id}}" readonly>
          </div>
        </div>

        <div class="form-group">
          <label for="warehouse" class="control-label col-md-2">Gudang</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="warehouse" value="{{$rw->goodsOutWarehouse->warehouse->name}}" readonly>
          </div>
        </div>

        <div class="form-group">
          <label for="date" class="control-label col-md-2">Tanggal</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="date" value="{{$rw->date}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('warehouse') ? 'has-error' : ''}}">
          <label for="goods" class="control-label col-md-2">Barang</label>
          <div class="col-md-10">
            <table class="table table-bordered table-hovered">
              <thead>
                <tr>
                  <th rowspan="2" width="1%"><center>No</centero</th>
                  <th rowspan="2"><center>Nama Barang</center></th>
                  <th colspan="2"><center>Barang Retur</center></th>
                  <th colspan="2"><center>Bad Stock</center></th>
                  <th rowspan="2" width="25%"><center>Keterangan</center></th>
                </tr>
                <tr>
                  <th width="12%"><center>Jml (BOX)</center></th>
                  <th width="12%"><center>Jml (PCS)</center></th>
                  <th width="12%"><center>Jml (BOX)</center></th>
                  <th width="12%"><center>Jml (PCS)</center></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rwd as $item)
                <tr>
                  <td><center>{{$no}} <input type="hidden" id="goods{{$no}}" name="goods[]" value="{{$item->id_goods}}"></center></td>
                  <td>{{$item->goods->name}} <input type="hidden" id="goods2{{$no}}" value="{{$item->goods->name}}"></td>
                  <td><input type="text" class="form-control qyt_box{{$no}}" id="qyt_box{{$no}}" name="qyt_box[]" value="{{$item->qyt_box}}"></td>
                  <td><input type="text" class="form-control qyt_pcs{{$no}}" id="qyt_pcs{{$no}}" name="qyt_pcs[]" value="{{$item->qyt_pcs}}"></td>
                  <td><input type="text" class="form-control bad_box{{$no}}" id="bad_box{{$no}}" name="bad_box[]" value="{{$item->bad_stock_box}}"></td>
                  <td><input type="text" class="form-control bad_pcs{{$no}}" id="bad_pcs{{$no}}" name="bad_pcs[]" value="{{$item->bad_stock_pcs}}"></td>
                  <td><textarea type="text" class="form-control description{{$no}}" id="description{{$no++}}" name="description2[]" rows="1">{{$item->description}}</textarea></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="form-group {{$errors->has('description2') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-10">
            <textarea id="description" name="description" class="form-control" rows="3" maxlength="255" readonly>{{$rw->description}}</textarea>
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
  <script type="text/javascript">
    $(document).ready(function(){

      var id_gow = "{{$rw->id_goods_out_warehouse}}";
      var id_res = "{{$rw->id}}";

      @foreach ($rwd as $g => $value)
        $("#qyt_box{{$g+1}}").keyup(function(){
          var id_barang{{$g+1}} = $("#goods{{$g+1}}").val();
          var nama{{$g+1}} = $("#goods2{{$g+1}}").val();
          var qyt_box{{$g+1}} = $(this).val();
          $.get("/barang_keluar/gudang/detail/cek/barang/"+id_barang{{$g+1}}+'/'+id_gow, function(res1){
            $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_barang{{$g+1}}+"/"+id_res, function(res2){
              if (parseInt(qyt_box{{$g+1}}) > parseInt(res1.qyt_box)) {
                alert(nama{{$g+1}}+" melebihi jumlah barang (box) keluar, jumlah barang keluar "+res1.qyt_box+" (box)");
                if (parseInt(res2.qyt_box) > 0) {
                  $("#qyt_box{{$g+1}}").val(res2.qyt_box);
                } else {
                  $("#qyt_box{{$g+1}}").val(null);
                }
              }
            });
          });
        });
      @endforeach

      @foreach ($rwd as $h => $value)
        $("#qyt_pcs{{$h+1}}").keyup(function(){
          var id_barang{{$h+1}} = $("#goods{{$h+1}}").val();
          var nama{{$h+1}} = $("#goods2{{$h+1}}").val();
          var qyt_pcs{{$h+1}} = $(this).val();
          $.get("/barang_keluar/gudang/detail/cek/barang/"+id_barang{{$h+1}}+'/'+id_gow, function(res3){
            $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_barang{{$h+1}}+"/"+id_res, function(res4){
              if (parseInt(qyt_pcs{{$h+1}}) > parseInt(res3.qyt_pcs)) {
                alert(nama{{$h+1}}+" melebihi jumlah barang (pcs) keluar, jumlah barang keluar "+res3.qyt_pcs+" (pcs)");
                if (parseInt(res4.qyt_pcs) > 0) {
                  $("#qyt_pcs{{$h+1}}").val(res4.qyt_pcs);
                } else {
                  $("#qyt_pcs{{$h+1}}").val(null);
                }
              }
            });
          });
        });
      @endforeach

      @foreach ($rwd as $i => $value)
        $("#bad_box{{$i+1}}").keyup(function(){
          var id_barang{{$i+1}} = $("#goods{{$i+1}}").val();
          var nama{{$i+1}} = $("#goods2{{$i+1}}").val();
          var qyt_box{{$i+1}} = $("#qyt_box{{$i+1}}").val();
          var bad_box{{$i+1}} = $(this).val();
          if (qyt_box{{$i+1}} === "" || qyt_box{{$i+1}} === null) {
            alert(nama{{$i+1}}+" jumlah retur (Box) belum diisi");
            $("#bad_box{{$i+1}}").val(null);
            $("#qyt_box{{$i+1}}").focus();
          } else {
            $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_barang{{$i+1}}+"/"+id_res, function(res5){
              if(parseInt(bad_box{{$i+1}}) > parseInt(qyt_box{{$i+1}})) {
                alert(nama{{$i+1}}+" bad stok (box) melebihi jumlah retur");
                if (parseInt(res5.bad_stock_box) > 0) {
                  $("#bad_box{{$i+1}}").val(res5.bad_stock_box);
                } else {
                  $("#bad_box{{$i+1}}").val(null);
                }
              }
            });
          }
        });
      @endforeach

      @foreach ($rwd as $j => $value)
        $("#bad_pcs{{$j+1}}").keyup(function(){
          var id_barang{{$j+1}} = $("#goods{{$j+1}}").val();
          var nama{{$j+1}} = $("#goods2{{$j+1}}").val();
          var qyt_pcs{{$j+1}} = $("#qyt_pcs{{$j+1}}").val();
          var bad_pcs{{$j+1}} = $(this).val();
          if (qyt_pcs{{$j+1}} === "" || qyt_pcs{{$j+1}} === null) {
            alert(nama{{$j+1}}+" jumlah retur (Pcs) belum diisi");
            $("#bad_pcs{{$j+1}}").val(null);
            $("#qyt_pcs{{$j+1}}").focus();
          } else {
            $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_barang{{$j+1}}+"/"+id_res, function(res6){
              if(parseInt(bad_pcs{{$j+1}}) > parseInt(qyt_pcs{{$j+1}})) {
                alert(nama{{$j+1}}+" bad stok (pcs) melebihi jumlah retur");
                if (parseInt(res6.bad_stock_pcs) > 0) {
                  $("#bad_pcs{{$j+1}}").val(res6.bad_stock_pcs);
                } else {
                  $("#bad_pcs{{$j+1}}").val(null);
                }
              }
            });
          }
        });
      @endforeach

    });
  </script>
@endsection
