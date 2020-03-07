@extends('layouts.app')

@section('title','Menu')

@section('tombol')
<div class="btn-group pull-right m-t-15">
  <button id="tombol" type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#tambah">Tambah Data <span class=" m-l-5"><i class="fa fa-plus-circle"></i></span></button>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/')}}">Register</a>
  </li>
  <li>
    <a href="{{url('/menu')}}" class="active">Menu</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <h4 class="m-t-0 header-title"><b>Daftar Menu</b></h4>
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

        <table id="daftar-sk" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:25%">Nama Menu</th>
              <th style="width:10%">Link Icon</th>
              <th style="width:35%">Link Menu</th>
              <th style="width:10%">Tipe</th>
              <th style="width:15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->nama_menu}}</td>
              <td class="text-center"><i class="{{$d->icon}}"></i></td>
              <td>{{$d->link}}</td>
              <td>{{$d->tipe}}</td>
              <td>
                <a href="#" class="btn btn-link text-primary edit" data-id="{{$d->id}}" data-menu="{{$d->nama_menu}}" data-icon="{{$d->icon}}" data-link="{{$d->link}}" data-tipe="{{$d->tipe}}" data-toggle="modal" data-target="#tambah">
                  <i class="fa fa-edit"></i> </a>
                <form action="menu/{{$d->id}}" method="POST" style="display:inline;">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-link text-danger"><i class="fa fa-trash-o"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6">
                {{ $data->links() }}
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection

@section('modals')
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
        <h4 class="modal-title" id="myModal">Tambah Menu</h4>
      </div>
      <form method="POST" action="{{url('menu')}}">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="namaMenu">Nama Menu</label>
            <input type="text" name="nama_menu" id="namaMenu" class="form-control @error('nama_menu') is-invalid @enderror" value="{{old('nama_menu')}}">
          </div>
          <div class="form-group">
            <label for="linkIcon">Link Icon</label>
            <input type="text" name="icon" id="linkIcon" class="form-control @error('icon') is-invalid @enderror" value="{{old('icon')}}">
          </div>
          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link')}}">
          </div>
          <div class="form-group">
            <label for="tipe">Tipe</label>
            <select class="form-control" name="tipe" id="tipe">
              <option class="form-control" value="admin">Admin</option>
              <option class="form-control" value="user">User</option>
            </select>
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
      $('#tambah .modal-title').html('Tambah Menu');
      $('#tambah form').attr('action', `{{url('menu')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#namaMenu').val('');
      $('#linkIcon').val('');
      $('#link').val('');
      $('#tipe').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        menu = $(this).data('menu'),
        icon = $(this).data('icon'),
        link = $(this).data('link'),
        tipe = $(this).data('tipe');
      $('#tambah .modal-title').html('Rubah Menu');
      $('#tambah form').attr('action', `{{url('/menu/` + id + `')}}`);
      $('.patch').html('@method("patch")');
      $('#tambah button[type=submit]').html('Rubah');
      $('#namaMenu').val(menu);
      $('#linkIcon').val(icon);
      $('#link').val(link);
      $('#tipe').val(tipe);
    });
  });
</script>
@endsection