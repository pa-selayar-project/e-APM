@extends('layouts.app')

@section('title','Home')

@section('stylesheet')
<script>
	window.onload = function() {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light2",
			title: {
				text: "Chart Upload APM"
			},
			axisY: {
				suffix: "%",
				scaleBreaks: {
					autoCalculate: true
				}
			},
			data: [{
				type: "column",
				yValueFormatString: "#,##0\"%\"",
				indexLabel: "{y}",
				indexLabelPlacement: "inside",
				indexLabelFontColor: "white",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

	}
</script>
@endsection

@section('breadcumb')
@if (session('status'))
<div class="alert alert-success" role="alert">
	{{ session('status') }}
</div>
@endif

<p class="text-muted page-title-alt">Selamat datang {{Auth::user()->jenis_user}} {{Auth::user()->name}}!</p>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div id="chartContainer" style="height:350px;"></div>
	</div>
</div>

@endsection

@section('script')
<script src="{{url('assets/plugins/peity/jquery.peity.min.js')}}"></script>
<!-- jQuery  -->
<script src="{{url('assets/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
<script src="{{url('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{url('assets/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{url('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<script src="{{url('assets/pages/jquery.dashboard.js')}}"></script>
@endsection

@section('scriptcode')
<script src="{{url('assets/plugins/chart.js/chart.min.js')}}"></script>
<script src="{{url('assets/pages/jquery.chartjs.init.js')}}"></script>
<script src="{{url('assets/js/canvasjs.min.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.counter').counterUp({
			delay: 100,
			time: 1200
		});

		$(".knob").knob();

	});
</script>
@endsection