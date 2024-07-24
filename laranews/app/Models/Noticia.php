<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use HasFactory, SoftDeletes;
    
    // campos donde puede hacerse asignación masiva, evita inyección
    protected $fillable = ['titulo', 'tema', 'texto', 'imagen', 'user_id'];
    
    public static function getLast(int $number = 1){
        
        return self::whereNotNull('imagen')
            ->latest()->limit($number)->get();
    }
    
    public static function publicadas(){
        
        return self::where('published_at','!=',NULL)
            ->orderBy('published_at','DESC')
            ->paginate(config('pagination.noticias',10));
    }
    
    public static function noPublicadas(){
        
        return self::where('published_at',NULL)
        ->where('rejected',false)->latest()
        ->paginate(config('pagination.noticias',10));
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }
    
    public function incrementVisitas(){
        $this->visitas++;
        return $this->save();
    }
    
    public function allTemas(){
        return Noticia::select('tema')->distinct()->get();
    } 
    
}
