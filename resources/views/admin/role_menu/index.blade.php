@extends('layouts.app')

@section('title','Role Menu')

@section('tombol')
<div class="btn-group pull-right m-t-15">
  <button id="tombol" type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#tambah">Tambah Data <span class=" m-l-5"><i class="fa fa-plus-circle"></i></span></button>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/admin')}}">Register</a>
  </li>
  <li>
    <a href="{{url('/role_menu')}}" class="active">Role Menu</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <h4 class="m-t-0 header-title"><b>Daftar Role Menu</b></h4>
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
              <th style="width:50%">Nama Role</th>
              <th style="width:45%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->role}}</td>
              <td>
                <a href="#" class="btn btn-link text-primary edit" data-id="{{$d->id}}" data-role="{{$d->role}}" data-toggle="modal" data-target="#tambah">
                  <i class="fa fa-edit"></i> </a>
                <form action="role_menu/{{$d->id}}" method="POST" style="display:inline;">
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
      <form method="POST" action="{{url('role_menu')}}">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror" value="{{old('role')}}">
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
      $('#tambah .modal-title').html('Tambah Role Menu');
      $('#tambah form').attr('action', `{{url('admin/role_menu')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#role').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        role = $(this).data('role');
      $('#tambah .modal-title').html('Rubah Role Menu');
      $('#tambah form').attr('action', `{{url('admin/role_menu/` + id + `')}}`);
      $('.patch').html('@method("patch")');
      $('#tambah button[type=submit]').html('Rubah');
      $('#role').val(role);
    });
  });
</script>
@endsection