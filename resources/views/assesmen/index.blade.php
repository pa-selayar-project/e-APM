@extends('layouts.app')

@section('title','Assesmen')

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
    <a href="{{url('/assesmen')}}" class="active">Assesmen</a>
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
              <th style="width:25%">Area</th>
              <th style="width:25%">Kriteria</th>
              <th style="width:25%">Nomor Urut</th>
              <th style="width:20%">Aksi</th>
            </tr>
          </thead>
          <tbody>

            @if(!$data)
            <tr>
              <td height="300px" colspan="5">
                <h1 class="text-center text-muted mt-auto">Tidak ada Data</h1>
              </td>
            </tr>
            @endif
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->area}}</td>
              <td>{{$d->kriteria}}</td>
              <td>{{$d->nomor}}</td>
              <td>
                <a href=# class="edit m-r-15" data-id="{{$d->id}}" data-area="{{$d->area}}" data-kriteria="{{$d->kriteria}}" data-nomor="{{$d->nomor}}" data-toggle="modal" data-target="#tambah"><i class="fa fa-pencil-square-o fa-lg text-primary"></i></a>

                <form method="post" action="assesmen/{{$d->id}}" style="display:inline;">
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
              <td colspan="5">
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
        <h4 class="modal-title" id="myModal">Tambah Assesmen</h4>
      </div>
      <form method="POST" action="{{url('assesmen')}}">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <label for="area">Area</label>
            <input name="area" id="area" class="form-control @error('area') is-invalid @enderror" value="{{old('area')}}">
          </div>
          <div class="form-group">
            <label for="kriteria">Kriteria</label>
            <input name="kriteria" id="kriteria" class="form-control @error('kriteria') is-invalid @enderror" value="{{old('kriteria')}}">
          </div>
          <div class="form-group">
            <label for="nomor">Nomor Urut</label>
            <input name="nomor" id="nomor" class="form-control @error('nomor') is-invalid @enderror" value="{{old('nomor')}}">
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
      <form method="POST" action="{{url('assesmen/import')}}" enctype="multipart/form-data">
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
      $('#tambah .modal-title').html('Tambah Assesmen');
      $('#tambah form').attr('action', `{{url('/assesmen')}}`);
      $('.patch').html('');
      $('#tambah button[type=submit]').html('Tambah');
      $('#area').val('');
      $('#kriteria').val('');
      $('#nomor').val('');
    });

    $('.edit').on('click', function() {
      const id = $(this).data('id'),
        kriteria = $(this).data('kriteria'),
        area = $(this).data('area'),
        nomor = $(this).data('nomor');
      $('#tambah .modal-title').html('Rubah Assesmen');
      $('#tambah form').attr('action', `{{url('/assesmen/` + id + `')}}`);
      $('#tambah button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#area').val(area);
      $('#kriteria').val(kriteria);
      $('#nomor').val(nomor);
    });
  });
</script>
@endsection