<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionBatchRequest;
use App\Http\Requests\UpdateProductionBatchRequest;
use App\Models\Product;
use App\Models\ProductionBatch;
use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;

class ProductionBatchController extends Controller
{
    public function batchAll()
    {
        $batches = ProductionBatch::with(['product', 'workshop', 'user', 'reports'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['batches' => $batches]);
    }

    public function batchGet(ProductionBatch $batch)
    {
        $batch->load(['product', 'workshop', 'user', 'reports']);

        return response()->json(['batch' => $batch]);
    }

    public function batchAdd(StoreProductionBatchRequest $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $workshop = Workshop::where('id', $request->workshop_id)->first();

        if ($product && $workshop) {
            $batch = new ProductionBatch();
            $batch->batch_number = $request->batch_number;
            $batch->product_id = $request->product_id;
            $batch->workshop_id = $request->workshop_id;
            $batch->user_id = Auth::user()->id;
            $batch->shift_number = $request->shift_number;
            $batch->quantity_produced = $request->quantity_produced;
            $batch->status = $request->status ?? 'изготовлена';
            $batch->produced_at = $request->produced_at;
            $batch->save();

            return response()->json(['batch' => $batch], 201);
        } else {
            return response()->json(['errors' => 'Изделие или цех не найдены'], 404);
        }
    }

    public function batchEdit(UpdateProductionBatchRequest $request, ProductionBatch $batch)
    {
        $batch->quantity_produced = $request->quantity_produced;
        $batch->status = $request->status;
        $batch->save();

        return response()->json(['batch' => $batch]);
    }

    public function batchDelete(ProductionBatch $batch)
    {
        $batch->delete();

        return response()->json(['message' => 'deleted']);
    }
}
