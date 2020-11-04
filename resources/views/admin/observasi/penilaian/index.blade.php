@extends('layouts.app')

@section('title','Daftar Penilaian Observasi')

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
<div class="btn-group pull-right m-t-15 m-r-15">
  <a href="#importexcel" id="excel" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#importexcel">Import <span class=" m-l-5"><i class="fa fa-rocket"></i></span></a>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/dashboard')}}">Dashboard</a>
  </li>
  <li>
    <a href="{{url('admin/observasi/penilaian')}}" class="active">Penilaian Observasi</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <p class="text-muted font-13 m-b-30">
        </p>

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
        
        <table id="daftar-penilaian" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:50%">Penilaian</th>
              <th style="width:15%">Bobot</th>
              <th style="width:15%">Nilai</th>
              <th style="width:15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if($data == null)
            <tr>
              <td height="300px" colspan="5">
                <h1 class="text-center text-muted mt-auto">Tidak ada Data</h1>
              </td>
            </tr>
            @endif
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->penilaian}}</td>
              <td>{{$d->bobot}}</td>
              <td>{{$d->skor}}</td>
              <td>
                <a href=# class="edit m-r-15" data-id="{{$d->id}}" data-penilaian="{{$d->penilaian}}" data-kriteria="{{$d->lke_observasi_id}}" data-bobot="{{$d->bobot}}" data-toggle="modal" data-target="#tambah"><i class="fa fa-pencil-square-o fa-lg text-primary"></i></a>

                <form method="post" action="{{url('admin/observasi/penilaian')}}/{{$d->id}}" style="display:inline;">
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
<!-- //-------modal tambah/edit--------- -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
        <h4 class="modal-title" id="myModal">Tambah Penilaian</h4>
      </div>
      <form method="POST" action="{{url('admin/observasi/penilaian')}}">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="penilaian">Penilaian</label>
            <textarea name="penilaian" id="penilaian" class="form-control @error('penilaian') is-invalid @enderror">{{old('penilaian')}}</textarea>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="kriteria">Kriteria</label>
              <select class="form-control" name="lke_observasi_id" id="kriteria">
                @foreach($kriteria as $k)
                <option class="form-control" value="{{$k->id}}">{{$k->kriteria}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="bobot">Bobot</label>
              <input type="number" class="form-control" name="bobot" id="bobot">
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
</div>

<!-- //-------modal import--------- -->
<div id="importexcel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{url('admin/observasi/penilaian/import')}}" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            x
          </button>
          <h4 class="modal-title" id="myModal">Import Excel</h4>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <input type="file" name="imported" id="imported" class="form-control">
          </div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Import</button>
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
      $('#tambah .modal-title').html('Tambah Penilaian Observasi');
      $('#tambah form').attr('action', `{{url('admin/observasi/penilaian')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#penilaian').html('');
      $('#kriteria').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        penilaian = $(this).data('penilaian'),
        kriteria = $(this).data('kriteria');
        bobot = $(this).data('bobot');
      $('#tambah .modal-title').html('Rubah Data Penilaian');
      $('#tambah form').attr('action', `{{url('admin/observasi/penilaian/` + id + `')}}`);
      $('#tambah button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#penilaian').html(penilaian);
      $('#kriteria').val(kriteria);
      $('#bobot').val(bobot);
    });
  });
</script>
@endsection