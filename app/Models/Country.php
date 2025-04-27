<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'countries';
    protected $primaryKey = 'id';

    public $timestamps = true; // Si la tabla no tiene los campos created_at y updated_at en la BD poner false
    protected $fillable = [ // Campos que se pueden modificar de la tabla
        'name',
        'president',
        'size',
        'population',
        'flag',
        'language',
        'currency',
        'region_id'
    ];

    protected $hidden = [ // Campos que no queremos que se devuelvan en las consultas
        'active'
    ];

    protected $casts = [
        'size' => 'decimal:4',
    ];

    // Relación un país pertenece a una región
    public function region()
    {
        return $this->belongsTo(regions::class, 'region_id');
    }
    // Relación un país pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
