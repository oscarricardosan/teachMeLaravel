<?php

namespace TeachMe\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'tickets.list',
            \TeachMe\Http\ViewComposers\TicketsListComposer::class
            /*Se puede por clousure o clase
            function ($view){
                $view->title = trans(Route::currentRouteName().'_title');
                $view->text_total = Lang::choice(
                    'tickets.total',
                    $view->tickets->total(),
                    ['title' => strtolower($view->title)]
                );
            }*/
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
