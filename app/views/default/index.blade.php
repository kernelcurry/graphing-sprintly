@section('content')
	<div class="row">
		<div class="col-sm-12 text-center">
			<div class="btn-group-vertical">
				@foreach($products as $product)
					<a class="btn btn-default" href="{{ route('default.graph', $priduct->id) }}">{{ $product->name }}</a>
				@endforeach
			</div>
		</div>
	</div>
@stop