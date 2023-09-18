<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'value',
        'commission',
        'sale_date'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

}
