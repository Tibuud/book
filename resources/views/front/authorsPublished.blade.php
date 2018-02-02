@extends('layouts.master')

@section('content')

<h1>Auteurs publiés</h1>
{{$authors->links()}}
@forelse($authors as $author)
<ul>
	<li><a href="{{url('author', $author->id)}}">{{$author->name}}</a></li>
</ul>
@empty
@endforelse

@endsection