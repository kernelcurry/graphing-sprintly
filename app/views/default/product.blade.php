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

			chart.lines
				.forceY([ 0 ]);
			chart.lines2
				.forceY([ 0 ]);

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
							key : 'Current' ,
							color : '#2ca02c',
							values : [
								@foreach($product->snapshots as $snapshot)
									{ x:{{ strtotime($snapshot->created_at)*1000 }} , y:{{ $snapshot->current_total() }} },
								@endforeach
							]
						},
						{
							key : 'Backlog' ,
							color : '#ff7f0e',
							values : [
								@foreach($product->snapshots as $snapshot)
									{ x:{{ strtotime($snapshot->created_at)*1000 }} , y:{{ $snapshot->backlog_total() }} },
								@endforeach
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