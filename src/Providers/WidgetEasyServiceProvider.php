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
        $this->loadViewsFrom(__DIR__ . "/../resources/views", "widget-easy");

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
            __DIR__.'/../resources/views/components' => resource_path('views/components/widget-easy'),
        ], 'resources');

        /*
        |---------------------------------------------------
        | Alias blade
        |---------------------------------------------------
        */
        Blade::component("components.widget-easy.widget_actions","widget_actions");
        Blade::component("components.widget-easy.widget_children","widget_children");
        Blade::component("components.widget-easy.widget_container","widget_container");
        Blade::component("components.widget-easy.sides.widget_side","widget_side");
        Blade::component("components.widget-easy.sides.widget_side_left","widget_left");
        Blade::component("components.widget-easy.sides.widget_side_right","widget_right");

        Blade::directive("WidgeteasyCSS", function(){
            return "<link rel='stylesheet' href=". asset('vendor/widget-easy/widgets/widgets.css'). " type='text/css'>";
        });

        Blade::directive("WidgeteasyJS", function(){
            return "<script type='text/javascript' src=".asset('vendor/widget-easy/widgets/widgets.js')."></script>";
        });
    }
}