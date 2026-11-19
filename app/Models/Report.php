<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'production_batch_id',
    'user_id',
    'title',
    'content',
    'accepted_quantity',
    'defective_quantity',
])]
class Report extends Model
{
    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
