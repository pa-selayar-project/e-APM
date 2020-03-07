@extends('layouts.app')

@section('title','Profil')

@section('tombol')
<div class="btn-group pull-right m-t-15">
  <button id="tombol" type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#ubahProfil" data-nama="{{$data->name}}" data-username="{{$data->username}}" data-email="{{$data->email}}">Ubah Profil <span class=" m-l-5"><i class="fa fa-plus-circle"></i></span></button>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/')}}">Register</a>
  </li>
  <li>
    <a href="{{url('/profil')}}" class="active">Profil</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">

        <p class="text-muted font-13 m-b-30"></p>

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if (session('message'))
        <div class=" alert alert-success">
          {{ session('message') }}
        </div>
        @endif
        <div class="col-sm-8 col-sm-offset-2">
          <table class="table table-responsive">
            <tbody>
              <tr>
                <td rowspan="4">
                  <img src="{{url('assets/images')}}/{{$data->image}}" class="img-thumbnail" height="220" width="160" />
                </td>
                <td>Nama / Username</td>
                <td>{{$data->name}} / {{$data->username}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$data->email}}</td>
              </tr>
              <tr>
                <td>Tipe User</td>
                <td>{{$data->jenis_user}}</td>
              </tr>
              <tr>
                <td>Password</td>
                <td>Password</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('modals')
<div id="ubahProfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
        <h4 class="modal-title" id="myModal">Ubah Profil</h4>
      </div>

      <form method="POST" action="{{url('profil')}}/{{$data->id}}" enctype="multipart/form-data">
        <div class="modal-body">
          @method('patch')
          @csrf
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
          </div>

          <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}">
          </div>

        </div>
    </div>
    <div class=" modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>
  </div>
</div>
@endsection

@section('scriptcode')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tombol').on('click', function() {
      const nama = $(this).data('nama'),
        username = $(this).data('username'),
        email = $(this).data('email');
      $('#name').val(nama);
      $('#username').val(username);
      $('#email').val(email);
    });
  });
</script>
@endsection