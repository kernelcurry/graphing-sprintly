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

			// chart.transitionDuration(500);
			chart.xAxis
					.tickFormat(d3.format(',f'));
			chart.x2Axis
					.tickFormat(d3.format(',f'));

			chart.yAxis
					.tickFormat(d3.format(',.2f'));
			chart.y2Axis
					.tickFormat(d3.format(',.2f'));

			d3.select('#chart svg')
					.datum(testData())
					.call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		});

		function testData() {
			return stream_layers(3,128,.1).map(function(data, i) {
				return {
					key: 'Stream' + i,
					values: data
				};
			});
		}
	</script>
@stop