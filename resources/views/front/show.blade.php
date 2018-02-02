@extends('layouts.master')
@section('content')
<div class="row">
	<h2 class="col-sm-12">{{$book->title}}</h2>
</div>
<div class="row">
	<img class="img-thumbnail col-sm-offset-4 col-sm-4 text-center" src="{{asset('images/'. $book->picture->link)}}">
</div>
<h2>Description :</h2>
<div>{{$book->description}}</div>
<ul>
	@forelse($book->authors as $author)
	<li><a href="{{url('author', $author->id)}}">{{$author->name}}</a></li>
	@empty
	<li>Aucun auteur trouvé</li>
	@endforelse
</ul>
<div class="row">
	<p class="col-sm-12">Moyenne des votants : {{round($book->avgVote(), 2)}}</p>
</div>
	@if ($errors->any())
	<div class="alert alert-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
@endif
	@if(Session::has('mon_message'))
    <div class="alert">
        <p>{{Session::get('mon_message')}}</p>
    </div>
@endif
	<form action="{{route('vote')}}" method="post" class="form-group">
	{{ csrf_field() }}
	<input type="hidden" name="book_id" value="{{$book->id}}">
	<input type="hidden" name="IP_visiteur" value="{{request()->ip()}}">
	<label for="vote">Souhaitez vous voter pour ce livre ?</label>
		<select name="vote" id="vote">
			@for ($i = 1; $i < 6; $i++)
        <option value="{{$i}}">{{$i}}</option>
    		@endfor
			<!-- <option value="1">1</option>		
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option> -->
		</select>
		
		<input type="submit" value="envoyer">
	</form>
@endsection