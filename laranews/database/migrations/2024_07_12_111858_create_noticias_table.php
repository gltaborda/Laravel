<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            
            $table->string('titulo',255);
            $table->string('tema',255);
            $table->string('texto',255);
            $table->string('imagen',255);
            $table->int('visitas',255);
            $table->string('tema',255);

            $table->deleted_at();
            $table->published_at();
            $table->rejected();
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('noticias');
    }
}
