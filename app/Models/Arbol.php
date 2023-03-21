<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbol extends Model
{
    use HasFactory;
    protected $table ='arbol';
    public $timestamps = false;
    

   protected $fillable = [
     
       'idFhater',
       'idSon',

   ];
}
