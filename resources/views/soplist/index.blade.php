@extends('layouts.app')

@section('title','Daftar SOP')

@section('content')
<div class="wrapper-page">
  <div class="ex-page-content text-center">
    <div class="text-error"><span class="text-primary">5</span><i class="ti-face-sad text-pink"></i><span class="text-info">3</span></div>
    <h2>Modul ini masih dalam pembangunan</h2><br>
    <div class="progress progress-lg">
      <div class="progress-bar progress-bar-success progress-bar-striped progress-animated wow animated" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
        <span class="sr-only">48% Complete</span>
      </div>
    </div>
    <br>
    <a class="btn btn-default waves-effect waves-light" href="{{url('home')}}"> Return Home</a>

  </div>
</div>
@endsection

@section('script')
<script src="{{url('assets/plugins/peity/jquery.peity.min.js')}}"></script>

<!-- jQuery  -->
<script src="{{url('assets/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
<script src="{{url('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

<script src="{{url('assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{url('assets/plugins/raphael/raphael-min.js')}}"></script>

<script src="{{url('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

<script src="{{url('assets/pages/jquery.dashboard.js')}}"></script>
@endsection