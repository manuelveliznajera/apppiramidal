<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $table ='affiliates';
    protected $primaryKey = 'idAffiliated';

    protected $fillable = [
        'SSN',
        'Name',
        'LastName',
        'AlternativePhone',
        'WorkPhone',
        'DateBirth',
        'Email',
        'confirmedEmail',
        'Address',
        'Country',
        'State',
        'City',
        'ZipCode',
        'Phone',
        'Latitude',
        'Longitude',
        'firstBuy',
        'StatusAff'
    ];
}
