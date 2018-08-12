@extends('layouts.print')

@section('title')
Cetak Kwitansi
@endsection

@section('main')
<div class="A5_landscape">
  <table class="table">
    <tr>
      <td rowspan="2" width="20%" height="1%"><center></center></td>
      <td width="40%" height=1%><font size="4px"><b>PT Jelajah Bersama Mandiri</b></font></td>
      <td><p style="text-align: right; margin:0px 0px 0px 0px;">Kode : {{$gow->id}}</p></td>
    </tr>
    <tr>
      <td>Area : Bogor</td>
      <td><p style="text-align: right; margin:0px 0px 0px 0px;">Tanggal : {{substr($gow->created_at,0,10)}}</p></td>
    </tr>
  </table>

  <br>

  <table class="table">
    <tr>
      <td width="10%">Dikirm Ke</td>
      <td width="1%">:</td>
      <td>{{$gow->warehouse->name}}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{$gow->warehouse->address}}</td>
    </tr>
  </table>

  <br>

  <table class="table" border="1px">
    <thead>
      <tr>
        <th rowspan="2" width="1%">No</th>
        <th rowspan="2">Nama Barang</th>
        <th colspan="2" width="15%">Bad Stock</th>
        <th colspan="2" width="15%">Good Stock</th>
        <th colspan="2" width="15%">Barang Keluar</th>
        <th rowspan="2" width="20%">Keterangan</th>
      </tr>
      <tr>
        <th width="8%">Jml (Box)</th>
        <th width="8%">Jml (Pcs)</th>
        <th width="8%">Jml (Box)</th>
        <th width="8%">Jml (Pcs)</th>
        <th width="8%">Jml (Box)</th>
        <th width="8%">Jml (Pcs)</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($gowd as $item)
      <tr>
        <td><center>{{$no++}}</center></td>
        <td>{{$item->goods->name}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><center>{{$item->qyt_box}}</center></td>
        <td><center>{{$item->qyt_pcs}}</center></td>
        <td>{{$item->description}}</td>
      </tr>
      @endforeach
      <tfoot>
        <tr>
          <th colspan="2">Total</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th>{{$gowds->qyt_box}}</th>
          <th>{{$gowds->qyt_pcs}}</th>
          <th></th>
        </tr>
      </tfoot>
    </tbody>
  </table>

  <div class="signature">
    <table class="table" border="1px">
      <tr>
        <td valign="top" rowspan="4"><b>Catatan :</b><br><p style="margin:0px 0px 0px 0px; text-align: justify;">{{$gow->description}}</p></td>
        <th colspan="2">Penerima</th>
        <th valign="center" rowspan="2" width="17%">Diterima Untuk</th>
        <th colspan="2">Area Pengirim</th>
      </tr>
      <tr>
        <th width="17%">Mengetahui</th>
        <th width="17%">Diterima Oleh</th>
        <th width="17%">Mengetahui</th>
        <th width="17%">Dibuat Oleh</th>
      </tr>
      <tr>
        <th height="80px"></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <th>&nbsp;<br>&nbsp;</th>
        <th></th>
        <th></th>
        <th></th>
        <th>{{$maker}}</th>
      </tr>
    </table>
  </div>

</div>
@endsection
