<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>KernelCurry - Graphing Sprintly</title>

		{{--<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">--}}
		<link href="{{ asset('css/default.css') }}" rel="stylesheet">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

		<script src="{{ asset('packages/nvd3/lib/d3.v3.js') }}"></script>
		<script src="{{ asset('packages/nvd3/nv.d3.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/tooltip.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/utils.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/models/legend.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/models/axis.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/models/scatter.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/models/line.js') }}"></script>
		<script src="{{ asset('packages/nvd3/src/models/lineWithFocusChart.js') }}"></script>
		<script src="{{ asset('packages/nvd3/stream_layers.js') }}"></script>
	</head>
	<body>
		<div class="container">
			<h1 class="text-center">Graphing Sprintly</h1>
			<p class="text-center"><b>Authors Site:</b> <a href="http://kernelcurry.com">kernelcurry.com</a> <b>Source Code:</b> <a href="https://github.com/kernelcurry/graphing-sprintly">github</a></p>
			@yield('content')
		</div>
	</body>
</html>