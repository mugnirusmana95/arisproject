@extends('layouts.index')

@section('title')
Ubah Detail Barang Masuk Dari Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Detail Barang Masuk Dari Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/retur/gudang">Barang Masuk Dari Gudang</a></li>
    <li><a href="/barang_masuk/retur/gudang/lihat/{{$rw->id}}">Detail Masuk Dari Gudang</a></li>
    <li class="active">Ubah Detail Barang Masuk Dari Gudang</li>
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
    <form class="form-horizontal" method="post" action="/barang_masuk/retur/gudang/detail/ubah/simpan/{{$rwd->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('gow') ? 'has-error' : ''}}">
          <label for="gow" class="control-label col-md-2">Id Baragn Keluar</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="gow" value="{{$rw->id_goods_out_warehouse}}" readonly>
            <input type="hidden" class="form-control" name="id" value="{{$rw->id}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('warehouse') ? 'has-error' : ''}}">
          <label for="warehouse" class="control-label col-md-2">Gudang <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="warehouse" value="{{$rw->goodsOutWarehouse->warehouse->name}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
          <label for="goods" class="control-label col-md-2">Barang</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="good" id="goods" value="{{$rwd->goods->name}}" readonly>
            <input type="hidden" class="form-control" name="goods" id="good" value="{{$rwd->id_goods}}" readonly>
            <p class="help-block">
              @if ($errors->has('goods'))
                {{$errors->first('goods')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_box') ? 'has-error' : ''}}">
          <label for="qyt_box" class="control-label col-md-2">Jumlah Retur (Box)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="qyt_box" name="qyt_box" value="@if(count($errors)>0){{old('qyt_box')}}@else{{$rwd->qyt_box}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_box'))
                {{$errors->first('qyt_box')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_pcsqyt_pcs') ? 'has-error' : ''}}">
          <label for="qyt_pcs" class="control-label col-md-2">Jumlah Retur (Pcs)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="qyt_pcs" name="qyt_pcs" value="@if(count($errors)>0){{old('qyt_pcs')}}@else{{$rwd->qyt_pcs}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_pcs'))
                {{$errors->first('qyt_pcs')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('bad_box') ? 'has-error' : ''}}">
          <label for="bad_box" class="control-label col-md-2">Bad Stock (Pcs)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="bad_box" name="bad_box" value="@if(count($errors)>0){{old('bad_box')}}@else{{$rwd->bad_stock_box}}@endif">
            <p class="help-block">
              @if ($errors->has('bad_box'))
                {{$errors->first('bad_box')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('bad_pcs') ? 'has-error' : ''}}">
          <label for="bad_pcs" class="control-label col-md-2">Bad Stock (Pcs)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="bad_pcs" name="bad_pcs" value="@if(count($errors)>0){{old('bad_pcs')}}@else{{$rwd->bad_stock_pcs}}@endif">
            <p class="help-block">
              @if ($errors->has('bad_pcs'))
                {{$errors->first('bad_pcs')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="description" rows="5">@if(count($errors)>0){{old('description')}}@else{{$rwd->description}}@endif</textarea>
            <p class="help-block">
              @if ($errors->has('description'))
                {{$errors->first('description')}}
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
<script type="text/javascript">
  $(document).ready(function(){
    var nama = $("#goods").val();
    var id_good = $("#good").val();
    var id_gow = "{{$rw->id_goods_out_warehouse}}";
    var id_rew = "{{$rw->id}}";

    $("#qyt_box").keyup(function(){
      var qyt_box = $(this).val();
      $.get("/barang_keluar/gudang/detail/cek/barang/"+id_good+'/'+id_gow, function(res1){
        $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_good+"/"+id_rew, function(res2){
          if (parseInt(qyt_box) > parseInt(res1.qyt_box)) {
            alert(nama+" melebihi jumlah barang (box) keluar, jumlah barang keluar "+res1.qyt_box+" (box)");
            if (parseInt(res2.qyt_box) > 0) {
              $("#qyt_box").val(res2.qyt_box);
            } else {
              $("#qyt_box").val(null);
            }
          }
        });
      });
    });

    $("#qyt_pcs").keyup(function(){
      var qyt_pcs = $(this).val();
      $.get("/barang_keluar/gudang/detail/cek/barang/"+id_good+'/'+id_gow, function(res3){
        $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_good+"/"+id_rew, function(res4){
          if (parseInt(qyt_pcs) > parseInt(res3.qyt_pcs)) {
            alert(nama+" melebihi jumlah barang (pcs) keluar, jumlah barang keluar "+res3.qyt_pcs+" (pcs)");
            if (parseInt(res4.qyt_pcs) > 0) {
              $("#qyt_pcs").val(res4.qyt_pcs);
            } else {
              $("#qyt_pcs").val(null);
            }
          }
        });
      });
    });

    $("#bad_box").keyup(function(){
      var bad_box = $(this).val();
      var qyt_box = $("#qyt_box").val();
      console.log(bad_box, qyt_box);
      if (qyt_box === "" || qyt_box === null) {
        alert(nama+" jumlah retur (Box) belum diisi");
        $("#bad_box").val(null);
        $("#qyt_box").focus();
      } else {
        $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_good+"/"+id_rew, function(res5){
          if(parseInt(bad_box) > parseInt(qyt_box)) {
            alert(nama+" bad stok (box) melebihi jumlah retur");
            if (parseInt(res5.bad_stock_box) > 0) {
              $("#bad_box").val(res5.bad_stock_box);
            } else {
              $("#bad_box").val(null);
            }
          }
        });
      }
    });

    $("#bad_pcs").keyup(function(){
      var bad_pcs = $(this).val();
      var qyt_pcs = $("#qyt_pcs").val();
      console.log(bad_pcs, qyt_pcs);
      if (qyt_pcs === "" || qyt_pcs === null) {
        alert(nama+" jumlah retur (Pcs) belum diisi");
        $("#bad_pcs").val(null);
        $("#qyt_pcs").focus();
      } else {
        $.get("/barang_masuk/retur/gudang/detail/cek/barang/"+id_good+"/"+id_rew, function(res5){
          if(parseInt(bad_pcs) > parseInt(qyt_pcs)) {
            alert(nama+" bad stok (pcs) melebihi jumlah retur");
            if (parseInt(res5.bad_stock_pcs) > 0) {
              $("#bad_pcs").val(res5.bad_stock_pcs);
            } else {
              $("#bad_pcs").val(null);
            }
          }
        });
      }
    });

  });
</script>
@endsection
