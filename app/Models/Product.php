<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'sku',
        'is_active'
    ];

    public function stockBalance()
{
    return $this->hasOne(StockBalance::class);
}

public function stockMovements()
{
    return $this->hasMany(StockMovement::class);
}
}
