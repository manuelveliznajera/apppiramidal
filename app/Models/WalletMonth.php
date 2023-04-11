<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletMonth extends Model
{
    use HasFactory;

    protected $table ='WalletWeek';
    public $timestamps = false;
    protected $fillable = [
      
        'id_user',
        'total',
        'fechaInicio',
        'FechaFin',
        'estado',
        'tipopago'

    ];
}
