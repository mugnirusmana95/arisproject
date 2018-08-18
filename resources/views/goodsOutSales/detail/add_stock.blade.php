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
    <form class="form-horizontal" method="post" action="/barang_keluar/sales/detail/tambah/stok/simpan/{{$gs->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group">
          <label for="sales" class="control-label col-md-2">Sales</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="sales" value="{{$gs->sales->name}}" readonly>
            <input type="hidden" class="form-control" name="id" value="{{$gs->id}}" readonly>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
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
                @foreach ($gsd as $item)
                <tr>
                  <td><center>{{$no}} <input type="hidden" id="goods{{$no}}" name="goods[]" value="{{$item->id_goods}}"></center></td>
                  <td>{{$item->goods->name}} <input type="hidden" id="goods2{{$no}}" value="{{$item->goods->name}}"></td>
                  <td><input type="text" class="form-control qyt_box{{$no}}" id="qyt_box{{$no}}" name="qyt_box[]" value="{{$item->qyt_box_out}}"><input type="hidden" class="form-control qyt_box_old{{$no}}" id="qyt_box_old{{$no}}" name="qyt_box_old[]" value="@if($item->qyt_box_out>0){{$item->qyt_box_out}}@else{{0}}@endif"></td>
                  <td><input type="text" class="form-control qyt_pcs{{$no}}" id="qyt_pcs{{$no}}" name="qyt_pcs[]" value="{{$item->qyt_pcs_out}}"><input type="hidden" class="form-control qyt_pcs_old{{$no}}" id="qyt_pcs_old{{$no}}" name="qyt_pcs_old[]" value="@if($item->qyt_pcs_out>0){{$item->qyt_pcs_out}}@else{{0}}@endif"></td>
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
            <textarea id="description" name="description" class="form-control" rows="3" maxlength="255" readonly>{{$gs->description}}</textarea>
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

      @foreach ($gsd as $g => $value)
        var no{{$g+1}} = "{{$g+1}}";
        $("#qyt_box"+no{{$g+1}}).keyup(function(){
          var id_goods{{$g+1}} = $("#goods{{$g+1}}").val()
          var nama{{$g+1}} = $("#goods2{{$g+1}}").val();
          var qyt_box{{$g+1}} = $(this).val();
          var qyt_box_old{{$g+1}} = $("#qyt_box_old{{$g+1}}").val();
          $.get('/master/barang/cek/stok/'+id_goods{{$g+1}}, function(res){
            var total{{$g+1}} = parseInt(res.qyt_box) + parseInt(qyt_box_old{{$g+1}});
            if (qyt_box{{$g+1}} > total{{$g+1}}) {
              alert(nama{{$g+1}}+" melebihi jumlah barang (box), jumlah saat ini "+total{{$g+1}}+" box");
              $("#qyt_box"+no{{$g+1}}).val(total{{$g+1}});
            }
          });
        });
      @endforeach

      @foreach ($gsd as $h => $value)
        var no{{$h+1}} = "{{$h+1}}";
        $("#qyt_pcs"+no{{$h+1}}).keyup(function(){
          var id_goods{{$h+1}} = $("#goods{{$h+1}}").val()
          var nama{{$h+1}} = $("#goods2{{$h+1}}").val();
          var qyt_pcs{{$h+1}} = $(this).val();
          var qyt_pcs_old{{$h+1}} = $("#qyt_pcs_old{{$h+1}}").val();
          $.get('/master/barang/cek/stok/'+id_goods{{$h+1}}, function(res){
            var total{{$h+1}} = parseInt(res.qyt_pcs) + parseInt(qyt_pcs_old{{$h+1}});
            if (qyt_pcs{{$h+1}} > total{{$h+1}}) {
              alert(nama{{$h+1}}+" melebihi jumlah barang (pcs), jumlah saat ini "+total{{$h+1}}+" pcs");
              $("#qyt_pcs"+no{{$h+1}}).val(total{{$h+1}});
            }
          });
        });
      @endforeach

    });
  </script>
@endsection
