<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWigdetEasyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgeteasy', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->text('widget_hidden')->nullable();
            $table->text('widget_position_left')->nullable();
            $table->text('widget_position_right')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widgeteasy');
    }
}
