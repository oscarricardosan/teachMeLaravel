<?php
/**
 * Created by PhpStorm.
 * User: masterdev
 * Date: 17/08/2016
 * Time: 23:52
 */

namespace TeachMe\Http\ViewComposers;


use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class TicketsListComposer
{
    public function compose($view)
    {
        $view->title = trans(Route::currentRouteName().'_title');
        $view->text_total = Lang::choice(
            'tickets.total',
            $view->tickets->total(),
            ['title' => strtolower($view->title)]
        );
    }
}