@extends('layouts.index')

@section('title')
Tambah Detail Barang Keluar Ke Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Detail Barang Keluar Ke Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_keluar/gudang">Barang Keluar Ke Gudang</a></li>
    <li><a href="/barang_keluar/gudang/lihat/{{$gow->id}}">Detail Barang Keluar Ke Gudang</a></li>
    <li class="active">Tambah Detail Barang Keluar Ke Gudang</li>
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
    <form class="form-horizontal" method="get" action="/barang_keluar/gudang/detail/tambah/simpan/{{$gow->id}}">
      {{ csrf_field() }}

      <div class="box-body">

        <input type="hidden" class="form-control" name="id" id="id" value="{{$gow->id}}" readonly>

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
                  <td><center>{{$no++}}</center></td>
                  <td>{{$item->goods->name}}</td>
                  <td><center>{{$item->qyt_box}}</center></td>
                  <td><center>{{$item->qyt_pcs}}</center></td>
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
            <select class="form-control" name="goods[]" id="goods" multiple="multiple">
              <option value=""></option>
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
  <script type="text/javascript">
    $(document).ready(function(){
      var id_goods = $("#id").val();
      $("#goods").select2({
        placeholder: "Pilih Barang",
        ajax: {
          url: '{{route('goods.getAllNotInWarehouseOut')}}',
          dataType: 'json',
          data: function (qyt){
              return{
                  id: id_goods,
                  q: $.trim(qyt.term)
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
