@extends('layouts.index')

@section('title')
Ubah Detail Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Detail Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_keluar/sales">Barang Keluar Ke Gudang</a></li>
    <li><a href="/barang_keluar/sales/lihat/{{$gs->id}}">Detail Keluar Ke Gudang</a></li>
    <li class="active">Ubah Detail Barang Keluar Ke Gudang</li>
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
    <form class="form-horizontal" method="post" action="/barang_keluar/sales/detail/ubah/simpan/{{$gsd->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('sales') ? 'has-error' : ''}}">
          <label for="sales" class="control-label col-md-2">Sales <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="sales" value="{{$gs->sales->name}}" readonly>
            <input type="hidden" class="form-control" name="id_goods_sales" value="{{$gs->id}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
          <label for="goods" class="control-label col-md-2">Barang</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="good" id="goods" value="{{$gsd->goods->name}}" readonly>
            <input type="hidden" class="form-control" name="goods" id="good" value="{{$gsd->id_goods}}" readonly>
            <p class="help-block">
              @if ($errors->has('goods'))
                {{$errors->first('goods')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_box') ? 'has-error' : ''}}">
          <label for="qyt_box" class="control-label col-md-2">Jumlah (Box)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="qyt_box" name="qyt_box" value="@if(count($errors)>0){{old('qyt_box')}}@else{{$gsd->qyt_box_out}}@endif">
            <input type="hidden" class="form-control" id="qyt_box_old" name="qyt_box_old" value="@if(count($errors)>0){{old('qyt_box')}}@else{{$gsd->qyt_box_out}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_box'))
                {{$errors->first('qyt_box')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_pcs') ? 'has-error' : ''}}">
          <label for="qyt_pcs" class="control-label col-md-2">Jumlah (Pcs)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="qyt_pcs" name="qyt_pcs" value="@if(count($errors)>0){{old('qyt_pcs')}}@else{{$gsd->qyt_pcs_out}}@endif">
            <input type="hidden" class="form-control" id="qyt_pcs_old" name="qyt_pcs_old" value="@if(count($errors)>0){{old('qyt_pcs')}}@else{{$gsd->qyt_pcs_out}}@endif">
            <p class="help-block">
              @if ($errors->has('qyt_pcs'))
                {{$errors->first('qyt_pcs')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="description" rows="5">@if(count($errors)>0){{old('description')}}@else{{$gsd->description}}@endif</textarea>
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

    $("#qyt_box").keyup(function(){
      var qyt_box = $(this).val();
      var qyt_box_old = $("#qyt_box_old").val();
      $.get('/master/barang/cek/stok/'+id_good, function(res){
        var total = parseInt(res.qyt_box) + parseInt(qyt_box_old);
        var new_qyt_box = parseInt(total) - parseInt(qyt_box);
        if(qyt_box > total) {
          alert(nama+" melebihi jumlah barang (box), jumlah saat ini "+total+" box");
          $("#qyt_box").val(total);
        }
      });
    });

    $("#qyt_pcs").keyup(function(){
      var qyt_pcs = $(this).val();
      var qyt_pcs_old = $("#qyt_pcs_old").val();
      $.get('/master/barang/cek/stok/'+id_good, function(res){
        var total = parseInt(res.qyt_pcs) + parseInt(qyt_pcs_old);
        var new_qyt_pcs = parseInt(total) - parseInt(qyt_pcs);
        if(qyt_pcs > total) {
          alert(nama+" melebihi jumlah barang (box), jumlah saat ini "+total+" box");
          $("#qyt_pcs").val(total);
        }
      });
    });
  });
</script>
@endsection
