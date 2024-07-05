<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCvDescriptionYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bikes', function(Blueprint $table){
            $table->string('descripcion', 100)->after('modelo')->nullable();
            $table->integer('cv')->unique()->after('kms')->nullable();
            $table->integer('year')->after('cv')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::tables('bikes', function(Blueprint $table){
            $table->dropColumn('descripcion');
            $table->dropColumn('cv');
            $table->dropColumn('year');
        });
    }
}
