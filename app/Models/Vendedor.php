<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'pais'
    ];

    public function Numeros()
    {
        return $this->hasMany(Numero::class);
    }

    public function Tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
