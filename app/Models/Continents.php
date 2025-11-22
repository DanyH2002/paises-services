<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Continents extends Model
{
    protected $table = 'continents';
    protected $primaryKey = 'id';

    public $timestamps = true; // Si la tabla no tiene los campos created_at y updated_at en la BD poner false
    protected $fillable = [ // Campos que se pueden modificar de la tabla
        'name'
    ];

    public static function getContinents()
    {
        return Continents::all();
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'continent_id');
    }
}
