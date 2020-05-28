@extends('layouts.app')

@section('title','Daftar Eviden')

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
    <a href="{{url('/')}}">Register</a>
  </li>
  <li>
    <a href="{{url('/eviden')}}" class="active">Daftar Eviden</a>
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

        <table id="daftar-sk" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:40%">Eviden</th>
              <th style="width:15%">Area</th>
              <th style="width:25S%">Kriteria</th>
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
              <td>{{$d->nama_eviden}}</td>
              <td>{{$d->area->nama_area}}</td>
              <td>{{$d->kriteria->nama_kriteria}}</td>
              <td>
                <a href=# class="edit m-r-15" data-id="{{$d->id}}" data-eviden="{{$d->nama_eviden}}" data-area="{{$d->area_id}}" data-kriteria="{{$d->kriteria_id}}" data-nomor="{{$d->nomor_urut}}" data-file="{{$d->file_upload}}" data-toggle="modal" data-target="#tambah"><i class="fa fa-pencil-square-o fa-lg text-primary"></i></a>

                <form method="post" action="eviden/{{$d->id}}" style="display:inline;">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-link m-r-15" title="Hapus"><i class="fa fa-trash fa-lg text-danger"></i></button>
                </form>


                @if($d->file_upload)
                <a href=# class="text-danger download" data-id="{{$d->id}}" data-target="#lihat" data-toggle="modal" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                <!-- <a href=# class="text-danger download" data-file="{{asset('assets/pdf')}}/{{$d->file_upload}}" data-target="#lihat" data-toggle="modal" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a> -->
                @else
                <a href=# class="edit m-r-15" data-id="{{$d->id}}" data-eviden="{{$d->nama_eviden}}" data-area="{{$d->area_id}}" data-kriteria="{{$d->kriteria_id}}" data-nomor="{{$d->nomor_urut}}" data-file="{{$d->file_upload}}" data-toggle="modal" data-target="#tambah"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
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
        <h4 class="modal-title" id="myModal">Tambah Eviden</h4>
      </div>
      <form method="POST" action="{{url('eviden')}}" enctype="multipart/form-data">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="nomor">Nama Eviden</label>
            <textarea name="nama_eviden" id="nama_eviden" class="form-control @error('nama_eviden') is-invalid @enderror">{{old('nama_eviden')}}</textarea>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="tanggal">Kriteria</label>
              <select class="form-control" name="kriteria_id" id="kriteria_id">
                @foreach($kriteria as $k)
                <option class="form-control" value="{{$k->id}}">{{$k->nama_kriteria}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="tipe">Area</label>
              <select class="form-control" name="area_id" id="area_id">
                @foreach($area as $a)
                <option class="form-control" value="{{$a->id}}">{{$a->nama_area}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="file_upload">Upload PDF</label>
              <input type="file" name="file_upload" id="file_upload" class="form-control @error('file_upload') is-invalid @enderror" value="{{old('file_upload')}}">
            </div>
            <div class="col-md-6">
              <label for="nomor_urut">Nomor Urut</label>
              <input type="text" name="nomor_urut" id="nomor_urut" class="form-control @error('nomor_urut') is-invalid @enderror" value="{{old('nomor_urut')}}">
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
      <form method="POST" action="{{url('eviden/import')}}" enctype="multipart/form-data">
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

<!-- //-------modal Download--------- -->
<div id="lihat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
      </div>
        <embed src="#" type="application/pdf" height="700px" width="100%">
    </div>
  </div>
</div>

@endsection

@section('scriptcode')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tombol').on('click', function() {
      $('#tambah .modal-title').html('Tambah Eviden');
      $('#tambah form').attr('action', `{{url('/eviden')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#nama_eviden').html('');
      $('#kriteria').val('');
      $('#area').val('');
      $('#nomor_urut').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        eviden = $(this).data('eviden'),
        kriteria = $(this).data('kriteria'),
        area = $(this).data('area'),
        nomor = $(this).data('nomor');
      $('#tambah .modal-title').html('Rubah Data SK');
      $('#tambah form').attr('action', `{{url('/eviden/` + id + `')}}`);
      $('#tambah button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#nama_eviden').html(eviden);
      $('#kriteria').val(kriteria);
      $('#area').val(area);
      $('#nomor_urut').val(nomor);
    });

    $('.download').on('click', function() {
      const id = $(this).data('id');

      $.ajax({
        url:'eviden/get_data/'+id,
        method:'get',
        success:function(result){
          $('#lihat embed').attr('src',  result);  
        }
      });
      
    });
  });
</script>
@endsection