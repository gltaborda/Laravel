<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;
    
    // campos donde puede hacerse asignación masiva, evita inyección
    protected $fillable = ['marca', 'modelo', 'kms', 'precio', 'matriculada'];
}
