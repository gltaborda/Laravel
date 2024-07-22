<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory, SoftDeletes;
    
    // campos donde puede hacerse asignación masiva, evita inyección
    protected $fillable = ['marca', 'modelo', 'descripcion', 'kms', 'precio', 'cv',
                            'year','matriculada', 'matricula', 'color', 'imagen', 'user_id'];

    public static function getLast(int $number = 1){
        
        return self::whereNotNull('imagen')
        ->latest()->limit($number)->get();   
    }
    
    // permite hacer $bike->user para recuperar directamente un user
    // mientras que hacer $bike->user() recupera una collection
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function incrementVisitas(){
        $this->cantidad_visitas++;
        return $this->save();
    }

}
