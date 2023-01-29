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
        $this->loadViewsFrom(__DIR__ . "/../resources/views/components", "widget-easy");

        /*
        |---------------------------------------------------
        | Publish
        |---------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/widget-easy'),
        ], 'public');

        if (! class_exists('CreateLanguageLinesTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../migrations/create_wigdet_easy_table.php.stub' => database_path('migrations/'.$timestamp.'_create_wigdet_easy_table.php'),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang'),
//            __DIR__.'/../resources/views/components' => resource_path('views/components/widget-easy'),
        ], 'resources');

        /*
        |---------------------------------------------------
        | Alias blade
        |---------------------------------------------------
        */
        Blade::component("widget-easy::container","widget-easy-container");
        Blade::component("widget-easy::actions","widget-easy-actions");
        Blade::component("widget-easy::children","widget-easy-children");
        Blade::component("widget-easy::side","widget-easy-side");

        Blade::directive("WidgeteasyCSS", function(){
            return "
                <link rel='stylesheet' href=". asset('vendor/widget-easy/widgets/widgets.css'). " type='text/css'>
                <link rel='stylesheet' href=". asset('vendor/widget-easy/box.css'). " type='text/css'>
            ";
        });

        Blade::directive("WidgeteasyJS", function(){
            return "<script type='text/javascript' src=".asset('vendor/widget-easy/widgets/widgets.js')."></script>";
        });
    }
}