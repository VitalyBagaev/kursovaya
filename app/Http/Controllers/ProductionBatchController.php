<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionBatchRequest;
use App\Http\Requests\UpdateProductionBatchRequest;
use App\Models\ProductionBatch;

class ProductionBatchController extends Controller
{
    public function index()
    {
        $batches = ProductionBatch::with(['product', 'workshop', 'user', 'reports'])->get();
        return response()->json($batches);
    }

    public function store(StoreProductionBatchRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $batch = ProductionBatch::create($data);
        $batch->load(['product', 'workshop', 'user', 'reports']);

        return response()->json($batch, 201);
    }

    public function show(ProductionBatch $batch)
    {
        $batch->load(['product', 'workshop', 'user', 'reports']);
        return response()->json($batch);
    }

    public function update(UpdateProductionBatchRequest $request, ProductionBatch $batch)
    {
        $batch->update($request->validated());
        $batch->load(['product', 'workshop', 'user', 'reports']);

        return response()->json($batch);
    }

    public function destroy(ProductionBatch $batch)
    {
        $batch->delete();
        return response()->json(['message' => 'Партия удалена']);
    }
}
