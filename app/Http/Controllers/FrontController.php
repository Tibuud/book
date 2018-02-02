<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book; //importez l'alias de la classe
use App\Author;
use App\Genre;
use App\Score;
use Cache;

class FrontController extends Controller
{
    // public function index(){

    // 	return Book::all(); //return tous les livres
    
    // }

    public function __construct(){

    	//méthode pour injecter des données à une vue partielle
    	view()->composer('partials.menu', function($view){
    		$genres = Genre::pluck('name', 'id')->all(); //on récupére un tableau associatif ['id' => 1]
    		$view->with('genres', $genres);// on passe les données à la view
    	});
    }

    public function index(){

        $prefix = request()->page?? 'home'; //Soit le numéro de la page, soit "home"
        $path = 'book' . $prefix;

        $books = Cache::remember($path, 60*24, function(){
            return Book::published()->with('picture', 'authors')->paginate(5);
        });


    	return view('front.index', ['books' => $books]);
    
    }


    public function show(int $id){

    	$genres = Genre::all();

    	return view('front.show', ['book' => Book::find($id)]);
    	// return Book::find($id);
    }

    public function showBookByAuthor(int $id){

    	$books = Author::find($id)->books()->paginate(5);
    	$author = Author::find($id);

    	return view('front.author', ['books' => $books , 'author' => $author]);
    }

    public function showBookByGenre(int $id){

		$books = Genre::find($id)->books()->paginate(5);
    	$genre = Genre::find($id);

    	return view('front.genre', ['books' => $books , 'genre' => $genre]);
    }

    public function create(Request $request) {

        // si une condtion renvoie false => redirectino vers le formulaire back()
        $this->validate($request, [
            // 'book_id' => 'integer|required', 
            'book_id' => "integer|required|uniqueVoteIp:{$request->IP_visiteur}", 
            'IP_visiteur' => 'ipv4|required', 
            'vote' => 'in:1,2,3,4,5',
            // 'foo' => 'required',
        ]);


        // dump($request->all());
        $score = Score::create($request->all()); //assignation de masse

        // dump($score);
        // return redirect('book/' . $request->book_id);
        return back()->with('mon_message', 'Merci de votre vote'); 



    }

}
