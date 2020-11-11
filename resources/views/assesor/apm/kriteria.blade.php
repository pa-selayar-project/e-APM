@extends('layouts.app')

@section('title','Daftar Kriteria APM')

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
  <button type="button" class="btn btn-primary waves-effect waves-light" onclick="javascript:history.back()" >Kembali <span class=" m-l-5"><i class="fa fa-plus-circle"></i></span></button>
</div>
@endsection

@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('#')}}">APM</a>
  </li>
  <li>
    <a href="{{url('assesor/apm')}}" class="active">Kriteria APM</a>
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

        <table class="table table-striped table-bordered">
          <tbody>
            @if($data == null)
            <tr>
              <td height="300px" colspan="2">
                <h1 class="text-center text-muted mt-auto">Tidak ada Data</h1>
              </td>
            </tr>
            @endif
            @foreach($data as $d)
            <tr>
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>
                <a href="{{url('assesor/apm/kriteria')}}/{{$d->id}}">
                {{$d->nama_kriteria}}
                </a>
              
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2">
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

