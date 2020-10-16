@extends('layouts.app')

@section('title','LKE Telusur Dokumen')

@section('stylesheet')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@endsection


@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/')}}">Register</a>
  </li>
  <li>
    <a href="{{url('/apm/lke')}}" class="active">LKE</a>
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

        <table id="lke1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:20%">Area </th>
              <th style="width:20%">Kriteria</th>
              <th style="width:45%">Panduan Eviden</th>
              <th style="width:10%">Upload Dokumen</th>
            </tr>
          </thead>
          <tbody>
            @if(!$data)
            <tr>
              <td height="300px" colspan="5">
                <h1 class="text-center text-muted m-t-40">Tidak ada Data</h1>
              </td>
            </tr>
            @endif

            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->area}}</td>
              <td>{{$d->kriteria}}</td>
              <td colspan="2">
                <table class="table table-striped" width="100%">
                  <?php $eviden = \App\Eviden::where('nomor_urut', $d->nomor)->get(); ?>
                  @foreach($eviden as $e)
                  <tr>
                    <td style="width:5%" valign="top">
                      {{$loop->iteration}}
                    </td>
                    <td style="width:78%" valign="top">
                      {{$e->nama_eviden}}
                    </td>
                    <td class="text-center" style="width:17%" valign="top">
                      @if($e->file_upload)
                      <a href=# class="text-danger download" data-id="{{$e->id}}" data-file="{{asset('assets/pdf')}}/{{$e->file_upload}}" data-target="#lihat" data-toggle="modal" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                      @else
                      <a href=# class="text-secondary upload" data-toggle="modal" data-id="{{$e->id}}" data-target="#tambah" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </table>
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
<!-- //-------modal Upload--------- -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          x
        </button>
        <h4 class="modal-title" id="myModal">Upload Dokumen</h4>
      </div>
      <form method="POST" action="{{url('lke')}}" enctype="multipart/form-data">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <div class="form-group">
            <input type="file" name="file_upload" id="file_upload" class="form-control @error('file_upload') is-invalid @enderror" value="{{old('file_upload')}}">
          </div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Upload</button>
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
      <div class="modal-body">
        <embed src="#" type="application/pdf" height="450px" width="100%">
      </div>
      <div class="modal-footer">
        <form method="POST" action="#">
          @csrf
          @method("PATCH")
          <button type="submit" class="btn btn-danger">
            Hapus File
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scriptcode')
<script type="text/javascript">
  $(document).ready(function() {
    $('.upload').on('click', function() {
      const id = $(this).data('id');
      $('#tambah form').attr('action', `{{url('/lke/` + id + `')}}`);
      $('.patch').html('@method("patch")');
    });

    $('.download').on('click', function() {
      const id = $(this).data('id');
      $('.modal-footer form').attr('action',  'lke/hapus_pdf/'+id);  

      $.ajax({
        url:'lke/get_data/'+id,
        method:'get',
        success:function(result){
          $('#lihat embed').attr('src',  result);  
        }
      });
      
    });
  });
</script>
@endsection