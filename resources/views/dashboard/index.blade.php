@extends('layouts.index')

@section('title')
Dashboard
@endsection

@section('main')
<section class="content-header">
  <h1>
    Dashboard
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">

  @if(substr($today,5,5) == substr($user->dob,5,5))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="fa fa-birthday-cake"></i> {{$today}}</h4>
      Selamat Ulang tahun @if($user->gender==1){{'Bapak '}}@elseif($user->gender==2){{'Ibu '}}@endif{{$user->first_name}}.
  </div>
  @endif

  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>Selamat Datang!</h4>
    @if($user->gender==1){{'Bapak '}}@elseif($user->gender==2){{'Ibu '}}@endif{{$user->first_name}} dan selamat beraktifitas.
  </div>

  @if ($check_password == true)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="fa fa-ban"></i> Danger!</h4>
      Kami mendeteksi bahwa anda masih menggunakan password default. Demi kemanan akun anda silahkan ganti password <a href="/profile/ubah_password">disini</a>.
    </div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Barang Masuk dan Keluar Tahun {{$year}}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <div class="chart" id="per-tahun" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Barang Masuk Hari Ini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <div class="chart" id="barang_masuk" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Barang Keluar Hari Ini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <div class="chart" id="barang_keluar" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (count($gos)>0)
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Barang keluar oleh sales yang belum kembali</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table class="table">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th width="1%"><center>ID</center></th>
                  <th>Nama Sales</th>
                  <th width="20%"><center>Tanggal</center></th>
                  <th width="20%"><center>Status</center></th>
                  <th width="1%"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gos as $item_gos)
                  <tr>
                    <td><center>{{$no_sales}}</center></td>
                    <td><center>{{$item_gos->id}}</center></td>
                    <td>{{$item_gos->sales->name}}</td>
                    <td><center>{{$item_gos->created_at}}</center></td>
                    <td><center><label class="label label-warning">Barang Belum Kembali</label></center></td>
                    <td>
                      <span data-toggle="tooltip" title="Lihat Data"><a href="/barang_keluar/sales/lihat/{{$item_gos->id}}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a><span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              &nbsp;
            </div>
          </div>
      </div>
    </div>
  @endif

</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    var bar_data_per_tahun = {
      data : [['Barang Masuk (BOX)', {{$total_in_box_year}}], ['Barang Masuk (PCS)', {{$total_in_pcs_year}}], ['Barang Keluar (BOX)', {{$total_out_box_year}}], ['Barang Keluar (PCS)', {{$total_out_pcs_year}}]],
      color: '#ff5353'
    }
    $.plot('#per-tahun', [bar_data_per_tahun], {
      grid  : {
        borderWidth: 1,
        borderColor: '#640000',
        tickColor  : '#640000'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.9,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    });

    var bar_data_barang_masuk = {
      data : [['(BOX)', {{$total_in_box}}], ['(PCS)', {{$total_in_pcs}}]],
      color: '#6772ff'
    }

    $.plot('#barang_masuk', [bar_data_barang_masuk], {
      grid  : {
        borderWidth: 1,
        borderColor: '#000764',
        tickColor  : '#000764'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    });

    var bar_data_barang_keluar = {
      data : [['(BOX)', {{$total_out_box}}], ['(PCS)', {{$total_out_pcs}}]],
      color: '#62ff5e'
    }
    $.plot('#barang_keluar', [bar_data_barang_keluar], {
      grid  : {
        borderWidth: 1,
        borderColor: '#026400',
        tickColor  : '#026400'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    });
  });
</script>
@endsection
