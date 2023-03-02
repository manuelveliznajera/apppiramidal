<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table ='webSites';
     public $timestamps = false;
     protected $primaryKey = 'idWebsite';

    protected $fillable = [
      
        
        'webSite',
        'idAffiliated'

    ];
}
