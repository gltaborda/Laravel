<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use HasFactory/*, SoftDeletes*/;
    
    // campos donde puede hacerse asignación masiva, evita inyección
    protected $fillable = ['texto', 'user_id', 'noticia_id'];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function noticia(){
        return $this->belongsTo('App\Models\Noticia');
    }
    
}
