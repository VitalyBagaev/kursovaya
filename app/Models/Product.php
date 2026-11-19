<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['sku', 'name', 'unit', 'standard_cost'])]
class Product extends Model
{
    public function productionBatches()
    {
        return $this->hasMany(ProductionBatch::class);
    }
}
