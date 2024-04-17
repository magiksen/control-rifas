<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'participante_id',
        'user_id',
    ];

    public function Participante()
    {
        return $this->belongsTo(Participante::class);
    }
    public function Vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
    public function Ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
