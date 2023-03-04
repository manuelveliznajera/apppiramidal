<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    public $timestamps = false;
    protected $primaryKey = 'idProd';
    protected $fillable = [
        
        'name',
        'img',
        'description',
        'idLine',
        'price',
        'active',
        'puntos'
    ];

    public function linea()
{
    return $this->belongsTo(Line::class, 'idLine');
}
}
