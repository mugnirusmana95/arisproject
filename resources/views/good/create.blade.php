@extends('layouts.index')

@section('title')
Tambah Barang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/barang">Barang</a></li>
    <li class="active">Tambah Barang</li>
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
    <form class="form-horizontal" method="post" action="/master/barang/tambah/simpan">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Nama <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Barang" value="{{old('name')}}">
            <p class="help-block">
              @if ($errors->has('name'))
                {{$errors->first('name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('pcs_per_box') ? 'has-error' : ''}}">
          <label for="pcs_per_box" class="control-label col-md-2">Jumlah Pcs Per Box <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="pcs_per_box" name="pcs_per_box" placeholder="Masukan Jumlah Barang Per Box" value="{{old('pcs_per_box')}}">
            <p class="help-block">
              @if ($errors->has('pcs_per_box'))
                {{$errors->first('pcs_per_box')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('qyt_box') ? 'has-error' : ''}}">
          <label for="qyt_box" class="control-label col-md-2">Jumlah (Box)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="qyt_box" name="qyt_box" placeholder="Masukan Jumlah Barang Per Box" value="{{old('qyt_box')}}">
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
            <input type="text" class="form-control" id="qyt_pcs" name="qyt_pcs" placeholder="Masukan Jumlah Barang Per Pcs" value="{{old('qyt_pcs')}}">
            <p class="help-block">
              @if ($errors->has('qyt_pcs'))
                {{$errors->first('qyt_pcs')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('bad_stock_box') ? 'has-error' : ''}}">
          <label for="bad_stock_box" class="control-label col-md-2">Bad Stock (Box)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="bad_stock_box" name="bad_stock_box" placeholder="Masukan Bad Stok (BOX)" value="{{old('bad_stock_box')}}">
            <p class="help-block">
              @if ($errors->has('bad_stock_box'))
                {{$errors->first('bad_stock_box')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('bad_stock_pcs') ? 'has-error' : ''}}">
          <label for="bad_stock_pcs" class="control-label col-md-2">Bad Stock (Pcs)</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="bad_stock_pcs" name="bad_stock_pcs" placeholder="Masukan Bad Stok (PCS)" value="{{old('bad_stock_pcs')}}">
            <p class="help-block">
              @if ($errors->has('bad_stock_pcs'))
                {{$errors->first('bad_stock_pcs')}}
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
      var name = $("#name").val();

      $("#bad_stock_box").change(function(){
        var bad_stock_box = parseInt($(this).val());
        var qyt_box = parseInt($("#qyt_box").val());
        if (qyt_box===null || qyt_box==="") {
          alert("Jumlah barang (box) belum diinput");
          $(this).val("");
        } else if(bad_stock_box > qyt_box) {
          alert("Bad Stok ("+bad_stock_box+" box) melebihi jumlah barang (box) jumlah yang diinputkan "+qyt_box+" box");
          $(this).val("");
        }
      });

      $("#bad_stock_pcs").change(function(){
        var bad_stock_pcs = parseInt($(this).val());
        var qyt_pcs = parseInt($("#qyt_pcs").val());
        if (qyt_pcs===null || qyt_pcs==="") {
          alert("Jumlah barang (pcs) belum diinput");
          $(this).val("");
        } else if(bad_stock_pcs > qyt_pcs) {
          alert("Bad Stok ("+bad_stock_pcs+" pcs) melebihi jumlah barang (pcs) jumlah yang diinputkan "+qyt_pcs+" pcs");
          $(this).val("");
        }
      });

    });
  </script>
@endsection
