<?php

namespace Gsferro\WidgetEasy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class WidgetEasyServiceProvider extends ServiceProvider
{
    public function register() {}
    public function boot()
    {
        /*
        |---------------------------------------------------
        | load
        |---------------------------------------------------
        */
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . "/../resources/views", "widgeteasy");

        /*
        |---------------------------------------------------
        | Publish
        |---------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/widgeteasy'),
        ], 'public');
        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations')
        ], 'migrations');

        /*
        |---------------------------------------------------
        | Alias blade
        |---------------------------------------------------
        */
        Blade::component("vendor/gsferro/widgeteasy/resources/views/widget_actions","widgetActions");
        Blade::component("vendor/gsferro/widgeteasy/resources/views/widget_children","widgetChild");

        Blade::directive("widgeteasyCSS", function(){
            return '<link rel="stylesheet" href="/vendor/gsferro/widgeteasy/resources/widgets/widgets.css" type="text/css">';
        });

        Blade::directive("widgeteasyJS", function(){
            return '<script type="text/javascript" src="/vendor/gsferro/widgeteasy/resources/widgets/widgets2.js"></script>';
        });

        Blade::directive("odometer", function(){
            return '
                <link rel="stylesheet" href="/vendor/gsferro/widgeteasy/resources/odometer/themes/odometer.css" type="text/css">
                <script type="text/javascript" src="/vendor/gsferro/widgeteasy/resources/odometer/odometer.js"></script>
            ';
        });
    }
}