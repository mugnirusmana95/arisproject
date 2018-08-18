@extends('layouts.index')

@section('title')
Tambah Barang Masuk Dari Gudang
@endsection

@section('main')
<section class="content-header">
  <h1>
    Tambah Barang Masuk Dari Gudang
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/barang_masuk/gudang">Barang Masuk Dari Gudang</a></li>
    <li class="active">Tambah Barang Masuk Dari Gudang</li>
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
    <form class="form-horizontal" method="post" action="/barang_masuk/gudang/tambah/simpan">
      {{ csrf_field() }}

      <div class="box-body">

        <div class="form-group {{$errors->has('warehouse') ? 'has-error' : ''}}">
          <label for="warehouse" class="control-label col-md-2">Gudang <span class="req">*</span></label>
          <div class="col-md-10">
            <select class="form-control" name="warehouse" required>
              <option value="">--Pilih Gudang--</option>
              @foreach ($warehouse as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>
            <p class="help-block">
              @if ($errors->has('warehouse'))
                {{$errors->first('warehouse')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('goods') ? 'has-error' : ''}}">
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
              </tbody>
            </table>

            <table>
              <tr>
                <td><input type="button" class="btn btn-md btn-success add-row" value="Tambah Baris"> <button type="button" class="btn btn-md btn-danger delete-row">Hapus Baris</button></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
          <label for="description" class="control-label col-md-2">Keterangan</label>
          <div class="col-md-10">
            <textarea name="description" class="form-control" rows="3" maxlength="255">{{old('description')}}</textarea>
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
<script>
$(document).ready(function(){
  $(".add-row").click(function(){
    var markup = "<tr>"+
                 "<td>"+
                 "<input type='checkbox' name='record' class='cek'>"+
                 "</td>"+
                 "<td>"+
                 "<select class='form-control goods' name='goods[]' required>"+
                 "<option value=''>--Pilih Barang--</option>"+
                 @foreach ($goods as $item)
                 "<option value='{{$item->id}}'>{{$item->name}}</option>"+
                 @endforeach
                 "</td>"+
                 "<td><input class='form-control' name='qyt_box[]' maxlength='4' placeholder='Masukan Jumlah Barang (Box)'></td>"+
                 "<td><input class='form-control' name='qyt_pcs[]' maxlength='4' placeholder='Masukan Jumlah Barang (Pcs)'></td>"+
                 "<td><textarea class='form-control' name='description2[]' placeholder='Masukan Keterangan' rows='1'></textarea></td>"+
                 "</tr>";
    $("#table tbody").append(markup);

    $('.goods').select2();
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
