<?php

use Illuminate\Database\Seeder;

// use Faker\Generator as Faker; // alias de nom de classe utiliser à la ligne 12

class BookTableSeeder extends Seeder
{
  // private $faker;
  
  // // injection de dépendance 
  // public function __construct(Faker $faker){
    
  //   $this->faker = $faker; // Laravel qui injectera le composant Faker directement 
    
  // }
  
//   public function run(){
    
//     factory(App\Book::class, 30)->create()->each(function($book){
      
//       dump($this->faker);
//     });
//   }
  
// }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // création des genres
        App\Genre::create([
            'name' => 'science'
        ]);
        App\Genre::create([
            'name' => 'maths'
        ]);
        App\Genre::create([
            'name' => 'cookbook'
        ]);

        //on prendra garde de bien supprimer toutes les images avant de commencer les seeders
        Storage::disk('local')->delete(Storage::allFiles());

        



        // création de 30 livres à partir de la factory
        factory(App\Book::class, 30)->create()->each(function($book){
            //associons un genre à un livre que nous vesons de créer
            $genre = App\Genre::find(rand(1,3));

            // pour chaque $book on lui associe un genre en particulier
            $book->genre()->associate($genre);
            $book->save(); //Il faut sauvegarder l'association pour faire persister en base de données

            //ajout des images
            //On utilise futurama sur lorempicsum pour récupérer des images aléatoirement
            //attention il n'y en a que 9 en tout de différentes
            $link = str_random(12) . "jpg"; //hash de lien pour la sécurité (injection de scripts protection)
            $file = file_get_contents('http://lorempicsum.com/futurama/250/250/' . rand(1,9));
            Storage::disk('local')->put($link, $file);

            $book->picture()->create([
                'title' => 'Default', //Valeur par défaut
                'link' => $link
            ]);

            //récupération des id des auteurs à partir de la méthode pluck d'éloquent
            // Les méthodes du pluck shuffle et slice permettent de mélanger et récupérer un certain nombre de 1 à 3 à partir de l'indice 0, comme ils sont mélangés à chaque fois qu'un livre est créé on aura des id à chaque fois aléatoire.
            $authors = App\Author::pluck('id')->shuffle()->slice(0,rand(1,3))->all();

            // Il faut se mettre maintenant en relation avec les auteurs (relation ManyToMany) et attacher les id des auteurs dans la table de liaison
            $book->authors()->attach($authors);
        });
    }
}
