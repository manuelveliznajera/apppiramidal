<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletWeek extends Model
{
    use HasFactory;
    protected $table ='walletweek';
    public $timestamps = false;
    protected $fillable = [
      
        'id_user',
        'total',
        'fechaInicio',
        'FechaFin',
        'estado',
        'tipopago'


    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
