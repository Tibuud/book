<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X6UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-witdh, initial-scale=1">
		<title>Book</title>
		<link rel="stylesheet" href="{{asset('css/app.css')}}">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@include('partials.menu')
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@yield('content')
				</div>
			</div>
		</div>
		@section('scripts')
		<script src="{{asset('js/app.js')}}"></script>
		@show
	</body>
</html>