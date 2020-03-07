@extends('layouts.app')

@section('title','Daftar SK')

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
    <a href="{{url('/')}}">Register</a>
  </li>
  <li>
    <a href="{{url('/sklist')}}" class="active">Daftar SK</a>
  </li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
        <h4 class="m-t-0 header-title"><b>Buttons example</b></h4>
        <p class="text-muted font-13 m-b-30">
          The Buttons extension for DataTables provides a common set of options, API methods and
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

        <table id="daftar-sk" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:25%">Nomor SK</th>
              <th style="width:10%">Tanggal</th>
              <th style="width:35%">Judul</th>
              <th style="width:10%">Penandatangan</th>
              <th style="width:15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if($data == '')
            <tr>
              <td height="300px" colspan="3">
                <h1 class="text-center text-muted mt-auto">Tidak ada Data</h1>
              </td>
            </tr>
            @endif
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->nomor_sk}}</td>
              <td>{{$d->tanggal}}</td>
              <td>{{$d->nama_sk}}</td>
              <td>{{$d->penandatangan}}</td>
              <td>
                <a href=# class="edit m-r-15" data-id="{{$d->id}}" data-nomor="{{$d->nomor_sk}}" data-tanggal="{{$d->tanggal}}" data-namask="{{$d->nama_sk}}" data-penandatangan="{{$d->penandatangan}}" data-file="{{$d->file_upload}}" data-toggle="modal" data-target="#tambah"><i class="fa fa-pencil-square-o fa-lg text-primary"></i></a>

                <form method="post" action="sklist/{{$d->id}}" style="display:inline;">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-link m-r-15" title="Hapus"><i class="fa fa-trash fa-lg text-danger"></i></button>
                </form>


                @if($d->file_upload)
                <a href=# class="text-danger download" data-file="{{asset('assets/pdf')}}/{{$d->file_upload}}" data-target="#lihat" data-toggle="modal" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                @else
                <a href=# class="text-secondary edit" data-id="{{$d->id}}" data-nomor="{{$d->nomor_sk}}" data-tanggal="{{$d->tanggal}}" data-namask="{{$d->nama_sk}}" data-penandatangan="{{$d->penandatangan}}" data-file="{{$d->file_upload}}" data-toggle="modal" data-target="#tambah" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                @endif
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
        <h4 class="modal-title" id="myModal">Tambah SK</h4>
      </div>
      <form method="POST" action="{{url('/sklist')}}" enctype="multipart/form-data">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="nomor">Nomor SK</label>
            <input type="text" name="nomor_sk" id="nomor" class="form-control @error('nomor') is-invalid @enderror" value="{{old('nomor')}}">
          </div>
          <div class="form-group">
            <label for="perihal">Perihal</label>
            <textarea rows="3" name="nama_sk" id="perihal" class=" form-control @error('perihal') is-invalid @enderror">{{old('perihal')}}</textarea>
          </div>
          <div class=" form-group row">
            <div class="col-md-6">
              <label for="tanggal">Tanggal</label>
              <input type="date" name="tanggal" id="tanggal" class=" form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal')}}">
            </div>
            <div class="col-md-6">
              <label for="tipe">Penandatangan SK</label>
              <select class="form-control" name="penandatangan" id="tipe">
                <option class="form-control" value="Ketua">Ketua</option>
                <option class="form-control" value="Sekretaris">Sekretaris</option>
                <option class="form-control" value="Panitera">Panitera</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="file_upload">Upload PDF</label>
            <input type="file" name="file_upload" id="file_upload" class="form-control @error('file_upload') is-invalid @enderror" value="{{old('file_upload')}}">
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

<!-- //-------modal Download--------- -->
<div id="lihat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
      </div>
      <center>
        <embed src="#" height="700px" width="700px">
      </center>
    </div>
  </div>
</div>

@endsection

@section('scriptcode')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tombol').on('click', function() {
      $('#tambah .modal-title').html('Tambah Data SK');
      $('form').attr('action', `{{url('/sklist')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#nomor').val('');
      $('#tanggal').val('');
      $('#perihal').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        nomor = $(this).data('nomor'),
        tanggal = $(this).data('tanggal'),
        namask = $(this).data('namask'),
        penandatangan = $(this).data('penandatangan');
      $('#tambah .modal-title').html('Rubah Data SK');
      $('#tambah form').attr('action', `{{url('/sklist/` + id + `')}}`);
      $('#tambah button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#nomor').val(nomor);
      $('#tanggal').val(tanggal);
      $('#perihal').val(namask);
      $('#tipe').val(penandatangan);
    });

    $('.download').on('click', function() {
      const file = $(this).data('file');
      $('embed').attr('src', file);
    });
  });
</script>
@endsection