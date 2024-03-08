<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'participante_id',
        'vendedor_id',
        'numero_id',
    ];

    public function Participante()
    {
        return $this->belongsTo(Participante::class);
    }
    public function Vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
    public function Numero()
    {
        return $this->belongsTo(Numero::class);
    }
}
