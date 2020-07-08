<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosPreferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_preferencias', function (Blueprint $table) {
            $table->string('login')->primary();
            $table->string('preferencia_skin')->default('skin-blue');
            $table->char('preferencia_fixed',1)->default('S')->comment('usado para layout adminlte com menu lateral');
            $table->char('preferencia_siderbar_mini', 1)->default('S')->comment('usado para layout adminlte com menu lateral');
            $table->text('widget_hidden')->nullable();
            $table->text('widget_position_left')->nullable();
            $table->text('widget_position_right')->nullable();
            $table->timestamps();

            $table->foreign( 'preferencia_fixed' )->references( 'sn_sigla' )->on( 'simnao' );
            $table->foreign( 'preferencia_siderbar_mini' )->references( 'sn_sigla' )->on( 'simnao' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_preferencias');
    }
}
