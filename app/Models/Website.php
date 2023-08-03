<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table ='websites';
     public $timestamps = false;
     protected $primaryKey = 'idWebsite';

    protected $fillable = [
      
        'webSite',
        'idAffiliated'

    ];

    public function affiliateWebSite(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function salesWebSite(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
