<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;
    protected $table ='sales';
    public $timestamps = false;
    
    protected $fillable = [
        
        'idSale',
        'idWebsite',
        'idProd',
        'datetimeb',
        'idAffiliated',
        'price',
        'ActivatedBuy',
        'TipoPago',
        'webShop',
        'WebNameClient',
        'WebEmailClient',
        'Shipping'
    ];


    public function webSite(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function productSale(): HasMany
    {
        return $this->hasMany(Product::class);
    }


}
