<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'code', 'description'])]
class Workshop extends Model
{
    public function productionBatches()
    {
        return $this->hasMany(ProductionBatch::class);
    }
}
