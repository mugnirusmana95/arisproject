@extends('layouts.index')

@section('title')
Ubah Barang Masuk Dari Sales
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Barang Masuk Dari Sales
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/sales">Barang Masuk Dari Sales</a></li>
    <li class="active">Ubah Barang Masuk Dari Sales</li>
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
  <div class="alert alert-warning alert-dismissible">
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
    <form class="form-horizontal" method="post" action="/barang_masuk/sales/ubah/simpan/{{$gs->id}}">
      {{ csrf_field() }}

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
                  <th rowspan="2" width="1%"><center>No</centero</th>
                  <th rowspan="2"><center>Nama Barang</center></th>
                  <th colspan="2"><center>Barang Keluar</center></th>
                  <th colspan="2"><center>Barang Kembali</center></th>
                  <th colspan="2"><center>Bad Stok</center></th>
                  <th rowspan="2" width="20%"><center>Keterangan</center></th>
                </tr>
                <tr>
                  <th width="1%"><center>Jml (BOX)</center></th>
                  <th width="1%"><center>Jml (PCS)</center></th>
                  <th width="9%"><center>Jml (BOX)</center></th>
                  <th width="9%"><center>Jml (PCS)</center></th>
                  <th width="9%"><center>Jml (BOX)</center></th>
                  <th width="9%"><center>Jml (PCS)</center></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gsd as $item)
                <tr>
                  <td><center>{{$no}} <input type="hidden" id="goods{{$no}}" name="goods[]" value="{{$item->id_goods}}"></center></td>
                  <td>{{$item->goods->name}} <input type="hidden" id="goods2{{$no}}" value="{{$item->goods->name}}"></td>
                  <td><center>{{$item->qyt_box_out}} <input type="hidden" class="form-control qyt_box_out{{$no}}" id="qyt_box_out{{$no}}" name="qyt_box_out[]" value="{{$item->qyt_box_out}}"></center></td>
                  <td><center>{{$item->qyt_pcs_out}} <input type="hidden" class="form-control qyt_pcs_out{{$no}}" id="qyt_pcs_out{{$no}}" name="qyt_pcs_out[]" value="{{$item->qyt_pcs_out}}"></center></td>
                  <td><input type="text" class="form-control qyt_box{{$no}}" id="qyt_box{{$no}}" name="qyt_box[]" value="{{$item->qyt_box_in}}"></td>
                  <td><input type="text" class="form-control qyt_pcs{{$no}}" id="qyt_pcs{{$no}}" name="qyt_pcs[]" value="{{$item->qyt_pcs_in}}"></td>
                  <td><input type="text" class="form-control bad_box{{$no}}" id="bad_box{{$no}}" name="bad_box[]" value="{{$item->bad_stok_box}}"></td>
                  <td><input type="text" class="form-control bad_pcs{{$no}}" id="bad_pcs{{$no++}}" name="bad_pcs[]" value="{{$item->bad_stok_pcs}}"></td>
                  <td>{{$item->description}}</td>
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
        $("#qyt_box{{$g+1}}").keyup(function(){
          $("#bad_box{{$g+1}}").val(null);
          var nama{{$g+1}} = $("#goods2{{$g+1}}").val();
          var qyt_box_out{{$g+1}} = $("#qyt_box_out{{$g+1}}").val();
          var qyt_box{{$g+1}} = $(this).val();
          if (parseInt(qyt_box{{$g+1}}) > parseInt(qyt_box_out{{$g+1}})) {
            alert(nama{{$g+1}}+" melebihi jumlah barang keluar (BOX)");
            $("#qyt_box{{$g+1}}").val("");
          }
        });
      @endforeach

      @foreach ($gsd as $h => $value)
        $("#bad_box{{$h+1}}").keyup(function(){
          var nama{{$h+1}} = $("#goods2{{$h+1}}").val();
          var bad_box{{$h+1}} = $(this).val();
          var qyt_box{{$h+1}} = $("#qyt_box{{$h+1}}").val();
          if(qyt_box{{$h+1}}==null || qyt_box{{$h+1}}==""){
            alert(nama{{$h+1}}+" jumlah barang kembali (BOX) masih kosong");
            $("#bad_box{{$h+1}}").val(null);
            $("#qyt_box{{$h+1}}").focus();
          } else {
            if(bad_box{{$h+1}} > qyt_box{{$h+1}}) {
              alert(nama{{$h+1}}+" melebihi jumlah barang kembali (BOX)");
              $("#bad_box{{$h+1}}").val(null);
            }
          }
        });
      @endforeach

      @foreach ($gsd as $i => $value)
        $("#qyt_pcs{{$i+1}}").keyup(function(){
          $("#bad_pcs{{$i+1}}").val(null);
          var nama{{$i+1}} = $("#goods2{{$i+1}}").val();
          var qyt_pcs_out{{$i+1}} = $("#qyt_pcs_out{{$i+1}}").val();
          var qyt_pcs{{$i+1}} = $(this).val();
          if (parseInt(qyt_pcs{{$i+1}}) > parseInt(qyt_pcs_out{{$i+1}})) {
            alert(nama{{$i+1}}+" melebihi jumlah barang keluar (PCS)");
            $("#qyt_pcs{{$i+1}}").val("");
          }
        });
      @endforeach

      @foreach ($gsd as $k => $value)
        $("#bad_pcs{{$k+1}}").keyup(function(){
          var nama{{$k+1}} = $("#goods2{{$k+1}}").val();
          var bad_pcs{{$k+1}} = $(this).val();
          var qyt_pcs{{$k+1}} = $("#qyt_pcs{{$k+1}}").val();
          if(qyt_pcs{{$k+1}}==null || qyt_pcs{{$k+1}}==""){
            alert(nama{{$k+1}}+" jumlah barang kembali (PCS) masih kosong");
            $("#bad_pcs{{$k+1}}").val(null);
            $("#qyt_pcs{{$k+1}}").focus();
          } else {
            if(bad_pcs{{$k+1}} > qyt_pcs{{$k+1}}) {
              alert(nama{{$k+1}}+" melebihi jumlah barang kembali (PCS)");
              $("#bad_pcs{{$k+1}}").val(null);
            }
          }
        });
      @endforeach

    });
  </script>
@endsection
