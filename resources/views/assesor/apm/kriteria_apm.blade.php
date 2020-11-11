@extends('layouts.app')

@section('title','Eviden Telusur Dokumen')

@section('stylesheet')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@endsection

@section('tombol')
<div class="btn-group pull-right m-t-15">
  <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:history.back()" >Kembali <span class=" m-l-5"><i class="fa fa-plus-circle"></i></span></button>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li><a href="{{url('#')}}">APM</a></li>
  <li><a href="{{url('assesor/apm')}}">Kriteria APM</a></li>
  <li><a href="{{url('#')}}" class="active">Eviden</a></li>
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
              <th style="width:5%;text-align:center">No</th>
              <th style="width:10%;text-align:center">Area </th>
              <th style="width:60%;text-align:center">Panduan Eviden</th>
              <th style="width:10%;text-align:center">Nilai</th>
            </tr>
          </thead>
          <tbody>
            @if(!$data)
            <tr>
              <td height="300px" colspan="3">
                <h1 class="text-center text-muted m-t-40">Tidak ada Data</h1>
              </td>
            </tr>
            @endif

            @foreach($data as $d)
            <tr>
              <td class="text-center">{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td class="text-center">{{$d->area}}</td>
              <td>
                <table class="table table-striped" width="100%">
                  @foreach(\App\Eviden::where('nomor_urut', $d->nomor)->get() as $e)
                  <tr>
                    <td style="width:5%" valign="top">
                      {{$loop->iteration}}
                    </td>
                    <td style="width:85%" valign="top">
                      {{$e->nama_eviden}}
                    </td>
                    <td style="width:10%" valign="top">
                       @if($e->file_upload)
                      <a href=# class="text-danger download" data-id="{{$e->id}}" data-target="#lihat" data-toggle="modal" title="Lihat PDF"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                      @else
                      <a href=# class="text-secondary" title="Tidak ada PDF"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </table>
              </td>
              <td class="text-center">
                <p>
                  {{$d->skor}}
                </p>
                <select name="nilai" class="nilai" data-id="{{$d->id}}" class="form-control">
                  <option class="input-group">Pilih</option>
                  <option class="input-group" value=100%>--A--</option>
                  <option class="input-group" value=50%>--B--</option>
                  <option class="input-group" value=0%>--C--</option>
                </select>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4">
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
      </div>
    </div>
  </div>
</div>
@endsection

@section('scriptcode')
<script type="text/javascript">
  $(document).ready(function() {
    $('.download').on('click', function() {
      const id = $(this).data('id');
      $.ajax({
        url:`{{url('getdatafile/` + id + `')}}`,
        method:'get',
        success:function(result){
          $('#lihat embed').attr('src',  result);  
        }
      });
    });

    $('.nilai').on('change', function(){
      const id = $(this).data('id');
        nilai = $('option:selected').val();
        console.log(nilai);
    });

  });
</script>
@endsection