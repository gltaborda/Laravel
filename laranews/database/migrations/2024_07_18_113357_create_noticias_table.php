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
            $table->integer('visitas')->default(0);
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            
            $table->boolean('rejected')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        });
            Schema::dropIfExists('noticias');
    }
}