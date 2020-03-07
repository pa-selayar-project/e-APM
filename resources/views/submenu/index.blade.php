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
    <a href="{{url('home')}}">Register</a>
  </li>
  <li>
    <a href="{{url('submenu')}}" class="active">Submenu</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <h4 class="m-t-0 header-title"><b>Daftar Submenu</b></h4>
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
              <th style="width:30%">Nama Submenu</th>
              <th style="width:30%">Link Submenu</th>
              <th style="width:20%">Parent</th>
              <th style="width:15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->nama_submenu}}</td>
              <td>{{$d->link}}</td>
              <td>{{$d->menu->nama_menu}}</td>
              <td>
                <a href="#" class="btn btn-link text-primary edit" data-id="{{$d->id}}" data-submenu="{{$d->nama_submenu}}" data-link="{{$d->link}}" data-parent="{{$d->menu_id}}" data-toggle="modal" data-target="#tambah">
                  <i class="fa fa-edit"></i> </a>
                <form action="submenu/{{$d->id}}" method="POST" style="display:inline;">
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
        <h4 class="modal-title" id="myModal">Tambah Submenu</h4>
      </div>
      <form method="POST" action="{{url('submenu')}}">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="namaSubMenu">Nama Submenu</label>
            <input type="text" name="nama_submenu" id="namaSubMenu" class="form-control @error('nama_submenu') is-invalid @enderror" value="{{old('nama_submenu')}}">
          </div>
          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link')}}">
          </div>
          <div class="form-group">
            <label for="menu_id">Parent</label>
            <select class="form-control" name="menu_id" id="menu_id">
              @foreach ($parent as $p)
              <option class="form-control" value="{{$p->id}}">{{$p->nama_menu}}</option>
              @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
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
      $('#tambah .modal-title').html('Tambah Submenu');
      $('#tambah form').attr('action', `{{url('submenu')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#namaSubMenu').val('');
      $('#link').val('');
      $('#menu_id').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        submenu = $(this).data('submenu'),
        link = $(this).data('link'),
        parent = $(this).data('parent');
      $('#tambah .modal-title').html('Ubah Submenu');
      $('#tambah form').attr('action', `{{url('submenu/` + id + `')}}`);
      $('.patch').html('@method("patch")');
      $('#tambah button[type=submit]').html('Ubah');
      $('#namaSubMenu').val(submenu);
      $('#link').val(link);
      $('#menu_id').val(parent);
    });
  });
</script>
@endsection