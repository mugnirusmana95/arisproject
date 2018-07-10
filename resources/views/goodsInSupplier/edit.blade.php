@extends('layouts.index')

@section('title')
Tambah Barang Masuk Dari Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Masuk Dari Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/barang_masuk/supplier">Barang Masuk Dari Supplier</a></li>
    <li class="active">Tambah Barang Masuk Dari Supplier</li>
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
    <form class="form-horizontal" method="post" action="/barang_masuk/supplier/ubah/simpan/{{$gis->id}}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('supplier') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Supplier <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" name="supplier" required>
              <option value="">--Pilih Supplier--</option>
              @foreach ($supplier as $item)
              <option value="{{$item->id}}" @if($item->id==$gis->id_supplier)selected @endif>{{$item->name}}</option>
              @endforeach
            </select>
            <p class="help-block">
              @if ($errors->has('supplier'))
                {{$errors->first('supplier')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('supplier') ? 'has-error' : ''}}">
          <label class="control-label col-md-2">Pilih Barang</label>
          <div class="col-md-10">
            <table class="table table-bordered" id="table">
              <thead>
                <tr>
                  <th width="1%"><input type='checkbox' class='cek' id='cek'></th>
                  <th><center>Nama Barang <span class="req">*</span></center></th>
                  <th width="25%"><center>Jumlah (Box)</center></th>
                  <th width="25%"><center>Jumlah (Pcs)</center></th>
                  <th width="25%"><center>Keterangan</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($gisd as $item2)
                <tr>
                  <td></td>
                  <td>
                    <select class="form-control" name="goods[]">
                      <option value="">--Pilih Barang--</option>
                      @foreach ($goods as $item3)
                      <option value="{{$item3->id}}" @if($item3->id==$item2->id_goods)selected @endif>{{$item3->name}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="text" class="form-control" name="qyt_box[]" maxlength="4" placeholder='Masukan Jumlah Barang (Box)' value="{{$item2->qyt_box}}"></td>
                  <td><input type="text" class="form-control" name="qyt_pcs[]" maxlength="4" placeholder='Masukan Jumlah Barang (Pcs)' value="{{$item2->qyt_pcs}}"></td>
                  <td><textarea class="form-control" name="description[]" maxlength="4" placeholder='Masukan Keterangan' rows="1">{{$item2->description}}</textarea></td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <table>
              <tr>
                <td><input type="button" class="btn btn-md btn-success add-row" value="Tambah Baris"> <button type="button" class="btn btn-md btn-danger delete-row">Hapus Baris</button></td>
              </tr>
            </table>
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
  $(".add-row").click(function(){
    var markup = "<tr>"+
                 "<td>"+
                 "<input type='checkbox' name='record' class='cek'>"+
                 "</td>"+
                 "<td>"+
                 "<select class='form-control' name='goods[]' required>"+
                 "<option value=''>--Pilih Barang--</option>"+
                 @foreach ($goods as $item)
                 "<option value='{{$item->id}}'>{{$item->name}}</option>"+
                 @endforeach
                 "</td>"+
                 "<td><input type='number' class='form-control' name='qyt_box[]' maxlength='4' placeholder='Masukan Jumlah Barang (Box)'></td>"+
                 "<td><input type='number' class='form-control' name='qyt_pcs[]' maxlength='4' placeholder='Masukan Jumlah Barang (Pcs)'></td>"+
                 "<td><textarea class='form-control' name='decsription[]' placeholder='Masukan Keterangan' rows='1'></textarea></td>"+
                 "</tr>";
    $("#table tbody").append(markup);
  });

  $(".delete-row").click(function(){
    $("table tbody").find('input[name="record"]').each(function(){
    	if($(this).is(":checked")){
          $(this).parents("tr").remove();
        }
    });
    $("#cek").prop('checked', false);
  });

  $("#cek").change(function(){  //"select all" change
    $(".cek").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});
});
</script>
@endsection
