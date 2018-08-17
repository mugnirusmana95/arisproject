@extends('layouts.index')

@section('title')
Ubah Foto Profile
@endsection

@section('main')
<section class="content-header">
  <h1>
    Ubah Foto Profile
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/profile">Profile</a></li>
    <li class="active">Ubah Foto Profile</li>
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
    <form class="form-horizontal" method="post" action="/profile/ubah_foto/simpan" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">

      <div class="box-body">

        <div class="form-group {{$errors->has('picture') ? 'has-error' : ''}}">
          <label for="old_password" class="control-label col-md-2">Foto Profile <span class="req">*</span></label>
          <div class="col-md-8">
            <input type="file" class="form-control" id="picture" name="picture" accept=".jpg, jpeg, .png">
            <p class="help-block">
              @if ($errors->has('picture'))
                {{$errors->first('picture')}}
              @endif
            </p>
            <img id="show" src="{{asset('images/profile/null.png')}}" height="100px">
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
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#show').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#picture").change(function() {
  readURL(this);
});
</script>
@endsection
