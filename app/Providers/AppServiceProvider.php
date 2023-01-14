<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Mail\PaymentCreated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Payment::created(function($payment){
            //TODO: make query and format pdf
            retry(3, function() use($affiliated, $pdf){
                Mail::to($email)->send(new PaymentCreated($affiliated, $pdf));
            },100);
        });*/
    }
}
