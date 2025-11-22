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
        'official_name',
        'president',
        'capital',
        'size',
        'population',
        'flag',
        'continent_id',
        'language_id',
        'currency_id',
        'latitude',
        'longitude',
        'user_id'
    ];

    protected $hidden = [ // Campos que no queremos que se devuelvan en las consultas
        'active'
    ];

    protected $casts = [
        'size' => 'decimal:4',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7'
    ];

    public function continent()
    {
        return $this->belongsTo(Continents::class, 'continent_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
