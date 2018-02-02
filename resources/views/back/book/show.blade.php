@extends('layouts.master')
@section('content')
<div class=row>
	<div class=col-sm-7>
		<div class=row>
			<h1 class=col-sm-12>
			Titre : {{$book->title}}
			</h1>
		</div>
		<div class="row">
			<div class=col-sm-12>
				Genre : {{$book->genre->name}}
			</div>
		</div>
		<div class="row">
			<div class=col-sm-12>
				Date de création : {{$book->created_at}}
			</div>
		</div>
		<div class="row">
			<div class=col-sm-12>
				Date de mise à jour : {{$book->updated_at}}
			</div>
		</div>
		<div class="row">
			<div class=col-sm-12>
				Status : TODO
			</div>
		</div>
	</div>
	<div class="col-sm-offset-1 col-sm-3">
		<div class=row>
			<h2 class=col-sm-12>
				IMAGE
			</h2>
		</div>
		<div class=row>
			<img class="img-thumbnail col-sm-12 text-center" src="{{asset('images/'. $book->picture->link)}}">
		</div>
	</div>
</div>
<div class="row">
	<h2 class="col-sm-12">Les auteurs</h2>
</div>
<div class="row">
	<ul class="col-sm-offset-1 col-sm-11">
		<li><strong>Nombre d'auteur : {{$book->authors->count()}}</strong></li>
@forelse($book->authors as $author)
		<li>{{$author->name}}</li>
@empty
@endforelse
	</ul>
</div>


@endsection