@extends('layouts.app')

@section('title','Daftar User')

@section('stylesheet')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
@endsection


@section('breadcumb')
<ol class=" breadcrumb">
  <li>
    <a href="{{url('/users')}}">Daftar user</a>
  </li>
  <li>
    <a href="{{url('/users')}}" class="active">User</a>
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
              <th style="width:25%">Nama / Username </th>
              <th style="width:25%">Email</th>
              <th style="width:45%">Jenis User</th>
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
              <td>{{$d->name}} / {{$d->username}}</td>
              <td>{{$d->email}}</td>
              <td>{{$d->jenis_user}}</td>
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