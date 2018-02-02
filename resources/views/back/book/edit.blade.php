@extends('layouts.master')
@section('content')
<h1>Create Book :</h1>



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form-horizontal" action="{{route('book.update', $book->id)}}" method="post" enctype="multipart/form-data">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}
	<div class=col-sm-8>
		<div class="form-group">
			<label class="control-label col-sm-2" for="title">Title:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{$book->title}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="description">Description:</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="description" name="description">{{$book->description}}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="genre">Genre:</label>
			<div class="col-sm-6">
				<select class="form-control" name="genre_id" id="genre">
					@forelse($genres as $id => $genre)
					@if($book->genre->id == $id)
					<option value="{{$book->genre->id}}" selected>{{$genre}}</option>
					@else
					<option value="{{$id}}">{{$genre}}</option>
					@endif
					@empty
					@endforelse
					<option value="0">no genre</option>
				</select>
			</div>
		</div>
		<h2>Choisissez un/des auteurs :</h2>
		@forelse($authors as $id => $authorName)
		@if(null !== $checkedAuthors)
		@if(in_array($id,$checkedAuthors))
		<label class="checkbox-inline"><input type="checkbox" value="{{$id}}" name="authors[]" checked>{{$authorName}}</label>
		@else
		<label class="checkbox-inline"><input type="checkbox" value="{{$id}}" name="authors[]">{{$authorName}}</label>
		@endif
		@else
		<label class="checkbox-inline"><input type="checkbox" value="{{$id}}" name="authors[]">{{$authorName}}</label>
		@endif
		@empty
		<p>Aucun auteur dans la base de donnée</p>
		@endforelse
	</div>
	<div class=col-sm-4>
		<button type="submit" class="btn btn-primary btn-lg">Ajouter ce livre</button>
		<h2>Status</h2>
		<div class="radio">
			<label><input type="radio" name="status" value='published' @if($book->status =='published') checked @endif>publier</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="status" value='unpublished' @if($book->status =='unpublished') checked @endif>dépublier</label>
		</div>
		<h2>File :</h2>
		<input type="file" name="picture" value="" id="picture">
		@if(isset($book->picture))
		<h3>Fichier image déjà présent :</h3>
		<img class="img-thumbnail  col-sm-12 text-center" src="{{asset('images/'. $book->picture->link)}}">
		@endif
	</div>
</form>
@endsection