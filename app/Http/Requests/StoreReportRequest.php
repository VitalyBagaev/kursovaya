<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'production_batch_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'accepted_quantity' => 'required',
            'defective_quantity' => 'required',
        ];
    }
}
