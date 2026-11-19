<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\Workshop;

class WorkshopController extends Controller
{
    public function index()
    {
        return response()->json(Workshop::all());
    }

    public function store(StoreWorkshopRequest $request)
    {
        $workshop = Workshop::create($request->validated());
        return response()->json($workshop, 201);
    }

    public function show(Workshop $workshop)
    {
        return response()->json($workshop);
    }

    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        $workshop->update($request->validated());
        return response()->json($workshop);
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return response()->json(['message' => 'Цех удалён']);
    }
}
