<?php

Route::group(['namespace' => 'Gsferro\WidgetEasy\Http\Controllers', 'middleware' => ['web']], function()
{
    Route::get('/widget-easy', 'WidgetEasyController')->name('widget-easy');
});