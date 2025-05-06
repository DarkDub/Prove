<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
    protected $fillable = ['nombre', 'correo', 'skill', 'latitude', 'longitude'];
}
