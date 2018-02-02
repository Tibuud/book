<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book; //importez l'alias de la classe
use App\Author;
use App\Genre;
use Storage;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $books = Book::paginate(10);

        return view('back.book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //permet de récupérer une collection type array avec en clé id => name
        $authors = Author::pluck('name', 'id')->all();
        $genres = Genre::pluck('name', 'id')->all();

        return view('back.book.create', ['authors' => $authors, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:books',
            'description' => 'required|string',
            'genre_id' => 'integer',
            'authors' => 'array',
            'authors.*' => 'integer',
            'status' => 'in:published,unpublished'
        ]);
        
        $book = Book::create($request->all());

        $image = $request->file('picture');

        if(!empty($image)){
            //faire quelque chose si $image existe
        }

        // méthode store retourne un link hash sécurisé
        $link = $request->file('picture')->store('./');

        //mettre à jour la table picture pour le lien vers l'image dans la base de données
        $book->picture()->create([
            'link' => $link,
            'title' => $request->title_image ?? $request->title
        ]);


        // On utilise le modèle Book et la relation authors ManyToMany pour attacher des/un nouveaux/nouvel auteur(s)
        // à un livre que l'on vient de créer en base de données.
        // Attention $request->authors correspond aux donnes du formulaire alors $book->authors() à la relation ManyToMany
        $book->authors()->attach($request->authors);

        return redirect()->route('book.index')->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('back.book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        //permet de récupérer une collection type array avec en clé id => name
        $checkedAuthors = $book->authors()->pluck('id')->all();
        $authors = Author::pluck('name', 'id')->all();
        $genres = Genre::pluck('name', 'id')->all();

        return view('back.book.edit', ['book' => $book, 'authors' => $authors, 'genres' => $genres, 'checkedAuthors' => $checkedAuthors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'genre_id' => 'integer',
            'authors' => 'array',
            'authors.*' => 'integer',
            'status' => 'in:published,unpublished'
        ]);
        
        // Il faut repérer le livre que l'on souhaite modifier
        $book = Book::find($id);

        $book->update($request->all()); //mettre à jour les données d'un  livre

        $book->authors()->sync($request->authors); //synchroniser les données avec la table de liaison

        $image = $request->file('picture');

        if(!empty($image)){
            //faire quelque chose si $image existe
            if(count($book->picture) > 0){

                Storage::disk('local')->delete($book->picture->link); //Supprime physiquement l'image
                $book->picture()->delete(); // supprimer l'information en base de donnée
            }

             // méthode store retourne un link hash sécurisé
            $link = $request->file('picture')->store('./');

            //mettre à jour la table picture pour le lien vers l'image dans la base de données
            $book->picture()->create([
                'link' => $link,
                'title' => $request->title_image ?? $request->title
            ]);
        }

        return redirect()->route('book.index')->with('message', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();

        return redirect()->route('book.index')->with('message', 'Success');
    }
}

//COUCOU