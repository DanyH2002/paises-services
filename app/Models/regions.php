<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regions extends Model
{
    protected $table = 'regions';
    protected $primaryKey = 'id';

    public $timestamps = true; // Si la tabla no tiene los campos created_at y updated_at en la BD poner false
    protected $fillable = [ // Campos que se pueden modificar de la tabla
        'name',
        'code',
        'description'
    ];

    // Relación uno a muchos, una region puede tener muchos paises
    public function countries()
    {
        return $this->hasMany('App\Models\Country');
    }

    // Obetener todas las regiones
    public static function getRegions()
    {
        return regions::all();
    }
}
