@extends('layouts.app')

@section('title','LKE Telusur Dokumen')

@section('stylesheet')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@endsection


@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('dashboard')}}">Dashboard</a>
  </li>
  <li>
    <a href="{{url('#')}}" class="active">LKE APM</a>
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
              <th style="width:20%">Kriteria </th>
              <th style="width:55%">Panduan Eviden</th>
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
              <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
              <td>{{$d->area}}</td>
              <td>{{$d->kriteria}}</td>
              <td>
                <table class="table table-striped" width="100%">
                  <?php $eviden = \App\Eviden::where('nomor_urut', $d->nomor)->get(); 
                  ?>
                  @foreach($eviden as $e)
                  <tr>
                    <td style="width:5%" valign="top">
                      {{$loop->iteration}}
                    </td>
                    <td style="width:78%" valign="top">
                      {{$e->nama_eviden}}
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