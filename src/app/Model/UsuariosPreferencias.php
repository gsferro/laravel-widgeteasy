<?php

namespace Gsferro\WidgetEasy\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UsuariosPreferencias extends Model
{
    protected $fillable = [
            "login",
            "preferencia_skin",
            "preferencia_fixed",
            "preferencia_siderbar_mini",
            "widget_hidden",
            "widget_position_left",
            "widget_position_right",
        ];
    protected $table      = "usuarios_preferencias";
    protected $primaryKey = "login";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope( 'login', function( Builder $builder ) {
            $builder->where( 'login', session( 'usuario' )[ "login" ] );
        } );
    }
}
