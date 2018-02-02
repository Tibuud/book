<?php

namespace App\Providers;

use App\Score;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // on va étendre les régles de la classe Validator

        Validator::extend('uniqueVoteIp', function ($attribute, $value, $parameters, $validator) {
            // dump($value);
            // dump($attribute);
            // dump($parameters[0]);
            $count_identique = (Score::where("book_id",$value)->where("IP_visiteur", $parameters[0])->count());

            if($count_identique > 0) {
                return false;
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}