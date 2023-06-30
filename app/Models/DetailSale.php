<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;
    protected $table ='DetailSale';
    public $timestamps = false;
    
    protected $fillable = [
        
        'id_sale',
        'id_product',
        'precioVenta',
        'cantidad',
        'subtotal',
        'NameProduct',
        'Tax'
    ];
}
