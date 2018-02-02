@extends('layouts.master')

@section('content')
<div class="row">
	<h1 class="col-md-12">Livres de {{$author->name}}</h1>
</div>
<div class="row">
	<div class="col-md-12">
		{{$books->links()}}
	</div>
</div>
<section>
	@forelse($books as $book)
	<article>
		<div class="row">
			<h2 class="col-md-12"><a href="{{url('book', $book->id)}}">{{$book->title}}</a></h2>
		</div>
		<div class="row">
			<div class="col-sm-4 thumbnail"><img src="{{asset('images/'.$book->picture->link)}}" alt=""></div>
			<div class="col-sm-8">{{$book->description}}</div>
		</div>
		<div class="row">
			<h3 class="col-md-12">Auteur(s):</h3>
		</div>
		<ul class="row">
			@forelse($book->authors as $author)
			<li><a href="{{url('author', $author->id)}}">{{$author->name}}</a></li>
			@empty
			<li>Aucun auteur trouvé</li>
			@endforelse
		</ul>
	</article>
	@empty
	<article>
		<div class="row">
			<h2 class="col-md-12">Désolé pour l'instant aucun livre n'est publié sur le site</h2>
		</div>
	</article>
	@endforelse
</section>
@endsection