<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string('poblacion')->after('email');
            $table->string('codigo_postal')->after('poblacion');
            $table->date('fecha_nacimiento')->after('codigo_postal')->default(19000101);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::tables('users', function(Blueprint $table){
            $table->dropColumn('poblacion');
            $table->dropColumn('codigo_postal');
            $table->dropColumn('fecha_nacimiento');
        });
    }
}
