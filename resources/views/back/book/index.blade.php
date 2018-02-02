@extends('layouts.master')

@section('content')
@include('back.book.partials.flash')
<button type="button" class="btn btn-primary btn-lg"><a style='text-decoration:none; color:white' href="{{route('book.create')}}">Ajouter un livre</a></button>
<div class="row">
	<div class="col-md-12">
		{{$books->links()}}
	</div>
</div>
 <table class="table table-bordered table-striped table-responsive">
    <thead>
      <tr>
        <th>Title</th>
        <th>Authors</th>
        <th>Genre</th>
        <th>date de publication</th>
        <th>Status</th>
        <th>Show</th>  
        <th>Editer</th>
        <th>Delete</th>                      
      </tr>
    </thead>
    <tbody>
@forelse($books as $book)
      <tr>
        <td>{{$book->title}}</td>
        <td>
			@forelse($book->authors as $author)
        	{{$author->name}}, 
        	@empty
        	@endforelse
        </td>
        <td>{{$book->genre->name}}</td>
        <td>{{$book->created_at}}</td>
        <td>{{$book->status}}</td>
        <td><a href="{{route('book.show', $book->id)}}">voir</a></td>
        <td><a href="{{route('book.edit', $book->id)}}">éditer</a></td>
        <td>
            <form action="{{ route('book.destroy', $book->id) }}" method="post" class='delete'>
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" >delete</button>
</form>
        </td>
      </tr>
@empty
  </tbody>
</table>
	<div class="col-md-12">Aucun livre présent dans la base de donnée</div>
</div>
@endforelse
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection