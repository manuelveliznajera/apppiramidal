<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;
    protected $table ='lineProduct';
    protected $fillable = [
        'idLine',
        'Line'
    ];

    public function Product(){
       return $this->hasMany(Product::class,'idProd');
    }
}
