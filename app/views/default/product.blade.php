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
		</div>
	</div>
@stop