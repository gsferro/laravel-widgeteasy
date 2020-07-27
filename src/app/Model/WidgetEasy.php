<?php

namespace Gsferro\WidgetEasy\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WidgetEasy extends Model
{
    protected $fillable = [
            "user_id",
            "widget_hidden",
            "widget_position_left",
            "widget_position_right",
        ];
    protected $table      = "widgeteasy";
    protected $primaryKey = "user_id";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope( 'user_id', function( Builder $builder ) {
            $builder->where( 'user_id', auth()->user()->id);
        } );
    }
}
