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
        <th width="1%">No</th>
        <th>Nama Barang</th>
        <th width="15%">Jumlah (Box)</th>
        <th width="15%">Jumlah (Pcs)</th>
        <th width="30%">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($gowd as $item)
      <tr>
        <td><center>{{$no++}}</center></td>
        <td>{{$item->goods->name}}</td>
        <td><center>{{$item->qyt_box}} @if(count($item->qyt_box)>0){{'box'}}@endif</center></td>
        <td><center>{{$item->qyt_pcs}} @if(count($item->qyt_pcs)>0){{'pcs'}}@endif</center></td>
        <td>{{$item->description}}</td>
      </tr>
      @endforeach
      <tfoot>
        @foreach ($gowds as $item2)
        <tr>
          <th colspan="2">Total</th>
          <th>{{$item2->qyt_box}} @if(count($item2->qyt_box)){{'box'}}@endif</th>
          <th>{{$item2->qyt_pcs}} @if(count($item2->qyt_pcs)){{'pcs'}}@endif</th>
          <th></th>
        </tr>
        @endforeach
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
        <th></th>
      </tr>
    </table>
  </div>

</div>
@endsection
