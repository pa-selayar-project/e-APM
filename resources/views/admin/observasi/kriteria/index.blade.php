@extends('layouts.app')

@section('title','Daftar Kriteria Observasi')

@section('stylesheet')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
@endsection

@section('tombol')
<div class="btn-group pull-right m-t-15">
  <button id="tombol" type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#tambah">Tambah Data <span class=" m-l-5"><i class="fa fa-plus-circle"></i></span></button>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/dashboard')}}">Dashboard</a>
  </li>
  <li>
    <a href="{{url('admin/observasi/kriteria')}}" class="active">Kriteria Observasi</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
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
              <th style="width:10%">No</th>
              <th style="width:70%">Kriteria</th>
              <th style="width:20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if(!$data)
            <tr>
              <td height="300px" colspan="3">
                <h1 class="text-center text-muted mt-auto">Tidak ada Data</h1>
              </td>
            </tr>
            @endif
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->kriteria}}</td>
              <td>
                <a href=# class="edit m-r-15" data-kriteria="{{$d->kriteria}}" data-id="{{$d->id}}" data-toggle="modal" data-target="#tambah"><i class="fa fa-pencil-square-o fa-lg text-primary"></i></a>

                <form method="post" action="{{url('admin/observasi/kriteria')}}/{{$d->id}}" style="display:inline;">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-link m-r-15" title="Hapus"><i class="fa fa-trash fa-lg text-danger"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">
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
<!-- //-------modal tambah/edit--------- -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
        <h4 class="modal-title" id="myModal">Tambah Kriteria</h4>
      </div>
      <form method="POST" action="{{url('admin/observasi/kriteria')}}">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="kriteria">Nama Kriteria</label>
            <input type="text" name="kriteria" id="kriteria" class="form-control @error('kriteria') is-invalid @enderror" value="{{old('kriteria')}}">
          </div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scriptcode')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tombol').on('click', function() {
      $('#tambah .modal-title').html('Tambah Kriteria');
      $('form').attr('action', `{{url('admin/observasi/kriteria')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#kriteria').val('');
    });

    $('.edit').on('click', function() {
      const kriteria = $(this).data('kriteria'),
        id = $(this).data('id');
      $('#tambah .modal-title').html('Rubah Kriteria');
      $('form').attr('action', `{{url('admin/observasi/kriteria/` + id + `')}}`);
      $('#tambah button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#kriteria').val(kriteria);
    });
  });
</script>
@endsection