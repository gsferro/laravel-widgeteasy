<?php

Route::group(['namespace' => 'Gsferro\WidgetEasy\Http\Controllers', 'middleware' => ['web']], function()
{
    Route::get('/widgeteasy', 'WidgetEasyController')->name('widgeteasy');
});