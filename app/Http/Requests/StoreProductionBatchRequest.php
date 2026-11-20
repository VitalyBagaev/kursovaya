<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionBatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'batch_number' => 'required',
            'product_id' => 'required',
            'workshop_id' => 'required',
            'shift_number' => 'required',
            'quantity_produced' => 'required',
            'produced_at' => 'required',
        ];
    }
}
