@extends('layouts.print')

@section('title')
Laporan Barang Masuk Dari Gudang Tanggal {{$date}}
@endsection

@section('main')
<div class="A4_portrait">
  <table class="table">
    <tr>
      <td rowspan="2" width="5%">
          <img src="{{asset('images/logo.png')}}" width="60px">
      </td>
      <td width="40%" height="1%" align="left"><font size="4px"><b>PT Jelajah Bersama Mandiri</b></font></td>
    </tr>
    <tr valign="top">
      <td><font size="4px"><b>Area : Bogor</b></font></td>
    </tr>
  </table>

  <br>
  <br>
  <br>
  <center><font size="4px"><b>Laporan Barang Masuk Dari Gudang ({{$date}})</b></font></center>
  <br>
  <br>

  <table class="table" border="1px">
    <thead>
      <tr>
        <th rowspan="2" width="1%"><center>No</center></th>
        <th rowspan="2"><center>Nama Barang</center></th>
        <th colspan="2"><center>Jumlah</center></th>
        <th colspan="2"><center>Bad Stocks</center></th>
        <th colspan="2"><center>Good Stocks</center></th>
      </tr>
      <tr>
        <th width="10%"><center>Box</center></th>
        <th width="10%"><center>Pcs</center></th>
        <th width="10%"><center>Box</center></th>
        <th width="10%"><center>Pcs</center></th>
        <th width="10%"><center>Box</center></th>
        <th width="10%"><center>Pcs</center></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($giware as $item)
      <tr>
        <td><center>{{$no++}}</center></td>
        <td>{{$item->goods->name}}</td>
        <td><center>@if($item->qyt_box == null){{0}}@else{{$item->qyt_box}}@endif</center></td>
        <td><center>@if($item->qyt_pcs == null){{0}}@else{{$item->qyt_pcs}}@endif</center></td>
        <td><center>@if($item->bad_stock_box==null){{0}}@else{{$item->bad_stock_box}}@endif</center></td>
        <td><center>@if($item->bad_stock_pcs==null){{0}}@else{{$item->bad_stock_pcs}}@endif</center></td>
        <td><center>@if($item->qyt_box - $item->bad_stock_box == null){{0}}@else{{$item->qyt_box - $item->bad_stock_box}}@endif</center></td>
        <td><center>@if($item->qyt_pcs - $item->bad_stock_pcs == null){{0}}@else{{$item->qyt_pcs - $item->bad_stock_pcs}}@endif</center></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
