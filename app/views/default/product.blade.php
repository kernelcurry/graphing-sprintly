@section('content')
	<div class="page-header">
			<h3>
				[{{ $product->id }}] {{ $product->name }}
				<div class="pull-right btn-group btn-group-xs">
						<a href="{{ route('default.index') }}" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
				</div>
			</h3>
	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<p>{{ $product->snapshots->count() }}</p>
			<div id="chart" class='with-3d-shadow with-transitions'>
				<svg style="height: 500px;"></svg>
			</div>
		</div>
	</div>
	<script>
		nv.addGraph(function() {
			var chart = nv.models.lineWithFocusChart();

			chart.xAxis
					.tickFormat(function(d) { return d3.time.format('%x')(new Date(d)) });
			chart.x2Axis
					.tickFormat(function(d) { return d3.time.format('%x')(new Date(d)) });

			chart.yAxis
					.tickFormat(d3.format(',f'));
			chart.y2Axis
					.tickFormat(d3.format(',f'));

			d3.select('#chart svg')
					.datum(
						[
							{
								"key" : "Line 1" ,
								"values" : [
									[ 1025409600000 , 23] , [ 1028088000000 , 19] , [1030766400000 , 10]
								]
							},
							{
								"key" : "Line 2" ,
								"values" : [
									[ 1025409600000 , 10] , [ 1028088000000 , 22] , [1030766400000 , 15]
								]
							}
						]
					)
					.call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		});
	</script>
@stop