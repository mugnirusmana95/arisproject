@extends('layouts.index')

@section('title')
Ubah Supplier
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Supplier
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/master/supplier">Supplier</a></li>
    <li class="active">Ubah Supplier</li>
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
  <div class="alert alert-danger alert-dismissible">
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
    <form class="form-horizontal" method="post" action="/master/supplier/ubah/simpan/{{$supplier->id}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT">

      <div class="box-body">

        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
          <label for="name" class="control-label col-md-2">Nama <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="name" placeholder="Masukan Nama Supplier" value="@if(count($errors)>0){{old('name')}}@else{{$supplier->name}}@endif">
            <p class="help-block">
              @if ($errors->has('name'))
                {{$errors->first('name')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
          <label for="phone" class="control-label col-md-2">Hanphone</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="phone" placeholder="Masukan Nomor Hanphone Supplier" value="@if(count($errors)>0){{old('phone')}}@else{{$supplier->phone}}@endif">
            <p class="help-block">
              @if ($errors->has('phone'))
                {{$errors->first('phone')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('telp') ? 'has-error' : ''}}">
          <label for="telp" class="control-label col-md-2">Telphone</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="telp" placeholder="Masukan Nomor Telpon Supplier" value="@if(count($errors)>0){{old('telp')}}@else{{$supplier->telp}}@endif">
            <p class="help-block">
              @if ($errors->has('telp'))
                {{$errors->first('telp')}}
              @endif
            </p>
          </div>
        </div>


        <div class="form-group {{$errors->has('fax') ? 'has-error' : ''}}">
          <label for="fax" class="control-label col-md-2">Fax</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="fax" placeholder="Masukan Nomor Fax Supplier" value="@if(count($errors)>0){{old('fax')}}@else{{$supplier->fax}}@endif">
            <p class="help-block">
              @if ($errors->has('fax'))
                {{$errors->first('fax')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
          <label for="email" class="control-label col-md-2">Email</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="email" placeholder="Masukan Email Supplier" value="@if(count($errors)>0){{old('email')}}@else{{$supplier->email}}@endif">
            <p class="help-block">
              @if ($errors->has('email'))
                {{$errors->first('email')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
          <label for="email" class="control-label col-md-2">Alamat</label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="address" placeholder="Masukan Alamat Supplier" value="{{old('address')}}" rows="3">@if(count($errors)>0){{old('address')}}@else{{$supplier->address}}@endif</textarea>
            <p class="help-block">
              @if ($errors->has('address'))
                {{$errors->first('address')}}
              @endif
            </p>
          </div>
        </div>

        <div class="form-group {{$errors->has('logo') ? 'has-error' : ''}}">
          <label for="logo" class="control-label col-md-2">Logo</label>
          <div class="col-md-8">
            <input type="file" class="form-control" id="logo" name="logo" accept=".jpg, .jpeg, .png">
            <p class="help-block">
              @if ($errors->has('logo'))
                {{$errors->first('logo')}}
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
