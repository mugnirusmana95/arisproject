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
    </tr>
    <tr>
      <td>Area : Bogor</td>
      <td><p style="text-align: right; margin:0px 0px 0px 0px;">Kode : {{$gs->id}}</p></td>
    </tr>
  </table>

  <br>
  <center><font size="4px"><b>PT Jelajah Bersama Mandiri</b></font></center>

  <table class="table">
    <tr>
      <td width="15%">Kode Salesman</td>
      <td width="1%">:</td>
      <td>{{$gs->id_sales}}</td>
    </tr>
    <tr>
      <td>Kode Nama</td>
      <td>:</td>
      <td>{{$gs->sales->name}}</td>
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
      @foreach ($gsd as $item)
      <tr>
        <td><center>{{$no++}}</center></td>
        <td>{{$item->goods->name}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><center>{{$item->qyt_box_out}}</center></td>
        <td><center>{{$item->qyt_pcs_out}}</center></td>
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
          <th>{{$gsds->qyt_box}}</th>
          <th>{{$gsds->qyt_pcs}}</th>
          <th></th>
        </tr>
      </tfoot>
    </tbody>
  </table>

  <div class="signature">
    <table class="table" border="1px">
      <tr>
        <td width="30%" valign="top">
          <table width="100%">
            <tr>
              <td align="left" width="40%"><b>Diambil Tgl<b></td>
              <td width="1%"><b>:<b></th>
              <td><b>{{substr($gs->created_at,0,10)}}</b></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
            <tr>
              <td align="left"><b>Gudang<b></td>
              <td><b>:<b></th>
              <td></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
            <tr>
              <td align="left"><b>Salesman<b></td>
              <td><b>:<b></th>
              <td></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
            <tr>
              <td align="left"><b>Supervisor<b></td>
              <td><b>:<b></th>
              <td></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
          </table>
        </td>
        <td align="left" valign="top" width="30%">
          <b>Catatan :</b><br>
          <p style="margin:0px 0px 0px 0px; text-align: justify;">{{$gs->description}}</p>
        </td>
        <td width="30%" valign="center" width="17%">
          <table width="100%">
            <tr>
              <td align="left" width="40%"><b>Diambil Kembali<b></td>
              <td width="1%"><b>:<b></th>
              <td><b></b></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
            <tr>
              <td align="left"><b>Gudang<b></td>
              <td><b>:<b></th>
              <td></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
            <tr>
              <td align="left"><b>Salesman<b></td>
              <td><b>:<b></th>
              <td></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
            <tr>
              <td align="left"><b>Supervisor<b></td>
              <td><b>:<b></th>
              <td></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></th>
              <td></th>
            </tr>
          </table>
        </th>
      </tr>
    </table>
  </div>

</div>
@endsection
