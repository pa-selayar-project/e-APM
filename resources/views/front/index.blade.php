<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>e APM</title>

	<!-- Fonts -->
	<link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
	<!-- <style>
	.jumbotron {
    position: relative;
    background: #000 url("https://images.unsplash.com/flagged/photo-1587096703738-43a53653e6a8") center center;
    width: 100%;
    height: 100%;
    background-size: cover;
    overflow: hidden;
	}
	
	</style> -->

</head>

<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="#">e APM</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a href="{{ url('/') }}" class="nav-link">Home</a>
					</li>
				@if (Route::has('login'))
					@auth
					<li class="nav-item">
						<a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
					</li>
				@else
					<li class="nav-item">
						<a href="{{route('login')}}" class="nav-link">Login</a>
					</li>
					@endauth
				@endif
				</ul>
			</div>
		</div>
	</nav>

	<!-- <div class="jumbotron jumbotron-fluid jumbotron-expand-lg">
		<div class="container my-5 py-5 text-white">
			<h1 class="display-1 mt-5">e APM</h1>
			<p class="lead">Akreditasi Penjaminan Mutu Pengadilan Agama Selayar</p>
			<div class="my-5">
				<a href="#lke" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Lihat LKE APM</a>
			</div>
		</div>
	</div> -->
	<div class="container py-5">
		<p id="lke" class="text-white">.</p>
		<h1 class="text-center m-b-20">LKE APM</h1>

		<div class="form-group row">
			<label class="form-label">Jenis LKE</label>
			<div class="input-group">
				<select id="area" class="chosen-select form-control">
					<option value="111">Pilih Jenis LKE</option>
					@foreach($area as $a)
					<option value="{{$a->id}}">{{$a->nama_area}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="container tabel-eviden">
		<div class="col col-md-12 table-responsive">
			<table id="lke1" class="table table-stripped" width="100%">
				<thead>
					<tr>
						<th style="width:5%">No</th>
						<th style="width:20%">Area </th>
						<th style="width:20%">Kriteria</th>
						<th style="width:50%">Panduan Eviden</th>
						<th style="width:5%">Upload Dokumen</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	
    <!-- //-------modal Download--------- -->

<div id="lihat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			</div>
			<div class="modal-body">
        <embed src="#" type="application/pdf" height="450px" width="100%"></embed>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<!-- jQuery  -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{url('vendors/chosen/chosen.jquery.js')}}"></script>
<script src="{{url('vendors/chosen/chosen.proto.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
      
		$(".chosen-select").chosen();

		$('#area').on('change', function(){
			const id=$(this).val();
			$('tbody').remove();
			$('tfoot').remove();
			$.ajax({
				url:'front/label/'+id,
        method:'get',
        success:function(result){
					$('thead').after(result); 
        }
			});
		
		}); 

		// $('.page-item a').on('click', function(event) {
		// 	event.preventDefault();
		// 	console.log($(this).attr('href'));
		// 	$('tbody').empty();
		// 	$('tfoot').remove();
		// 	// if ($(this).attr('href') != '#') {
		// 	// // $('tbody').load($(this).attr('href'));
		// 	// }
		// });

    $('.download a').on('click', function() {
      const id = $(this).data('id');

      $.ajax({
        url:'front/get_data/'+id,
        method:'get',
        success:function(result){
          $('#lihat embed').attr('src',  result);  
        }
      });
    });
  });   
</script>
</body>
</html>