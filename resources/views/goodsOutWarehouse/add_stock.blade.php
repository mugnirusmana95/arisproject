@extends('layouts.index')

@section('title')
Tambah Barang Keluar Ke Cabang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Keluar Ke Cabang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Cabang</a></li>
    <li class="active">Tambah Barang Keluar Ke Cabang</li>
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
    <form class="form-horizontal" method="post" action="/barang_keluar/gudang/tambah/stok/simpan/{{$gow->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group">
          <label for="warehouse" class="control-label col-md-2">Cabang</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="warehouse" value="{{$gow->warehouse->name}}" readonly>
            <input type="hidden" class="form-control" name="id" value="{{$gow->id}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('warehouse') ? 'has-error' : ''}}">
          <label for="goods" class="control-label col-md-2">Barang</label>
          <div class="col-md-10">
            <table class="table table-bordered table-hovered">
              <thead>
                <tr>
                  <th width="1%"><center>No</centero</th>
                  <th><center>Nama Barang</center></th>
                  <th width="20%"><center>Jumlah (Box)</center></th>
                  <th width="20%"><center>Jumlah (Pcs)</center></th>
                  <th width="30%"><center>Keterangan</center></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gowd as $item)
                <tr>
                  <td><center>{{$no}} <input type="hidden" id="goods{{$no}}" name="goods[]" value="{{$item->id_goods}}"></center></td>
                  <td>{{$item->goods->name}} <input type="hidden" id="goods2{{$no}}" value="{{$item->goods->name}}"></td>
                  <td><input type="text" class="form-control qyt_box{{$no}}" id="qyt_box{{$no}}" name="qyt_box[]" value="{{$item->qyt_box}}"></td>
                  <td><input type="text" class="form-control qyt_pcs{{$no}}" id="qyt_pcs{{$no}}" name="qyt_pcs[]" value="{{$item->qyt_pcs}}"></td>
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
            <textarea id="description" name="description" class="form-control" rows="3" maxlength="255" readonly>{{$gow->description}}</textarea>
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

      @foreach ($gowd as $g => $value)
        var no{{$g+1}} = "{{$g+1}}";
        $("#qyt_box"+no{{$g+1}}).keyup(function(){
          var id_goods{{$g+1}} = $("#goods{{$g+1}}").val()
          var nama{{$g+1}} = $("#goods2{{$g+1}}").val();
          var qyt_box{{$g+1}} = $(this).val();
          $.get('/master/barang/cek/stok/'+id_goods{{$g+1}}, function(res){
            if (qyt_box{{$g+1}} > res.qyt_box) {
              alert(nama{{$g+1}}+" melebihi jumlah barang (box), jumlah saat ini "+res.qyt_box+" box");
              $("#qyt_box"+no{{$g+1}}).val("");
            }
          });
        });
      @endforeach

      @foreach ($gowd as $h => $value)
        var no{{$h+1}} = "{{$h+1}}";
        $("#qyt_pcs"+no{{$h+1}}).keyup(function(){
          var id_goods{{$h+1}} = $("#goods{{$h+1}}").val()
          var nama{{$h+1}} = $("#goods2{{$h+1}}").val();
          var qyt_pcs{{$h+1}} = $(this).val();
          $.get('/master/barang/cek/stok/'+id_goods{{$h+1}}, function(res){
            if (qyt_pcs{{$h+1}} > res.qyt_pcs) {
              alert(nama{{$h+1}}+" melebihi jumlah barang (pcs), jumlah saat ini "+res.qyt_pcs+" pcs");
              $("#qyt_pcs"+no{{$h+1}}).val("");
            }
          });
        });
      @endforeach

    });
  </script>
@endsection
