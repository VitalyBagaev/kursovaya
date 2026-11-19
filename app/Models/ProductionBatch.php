<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'batch_number',
    'product_id',
    'workshop_id',
    'user_id',
    'shift_number',
    'quantity_produced',
    'status',
    'produced_at',
])]
class ProductionBatch extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
