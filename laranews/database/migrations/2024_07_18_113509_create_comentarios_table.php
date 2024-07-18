<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->string('texto',255);
            $table->timestamps();
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('noticia_id')->nullable();
            $table->foreign('noticia_id')
            ->references('id')->on('noticias')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('noticia_id');
        });
            
            Schema::dropIfExists('comentarios');
    }
}