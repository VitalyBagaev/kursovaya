<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\Workshop;

class WorkshopController extends Controller
{
    public function workshopAll()
    {
        $workshops = Workshop::orderBy('id', 'asc')->get();

        return response()->json(['workshops' => $workshops]);
    }

    public function workshopGet(Workshop $workshop)
    {
        return response()->json(['workshop' => $workshop]);
    }

    public function workshopAdd(StoreWorkshopRequest $request)
    {
        $workshop = new Workshop;
        $workshop->name = $request->name;
        $workshop->code = $request->code;
        $workshop->description = $request->description;
        $workshop->save();

        return response()->json(['workshop' => $workshop], 201);
    }

    public function workshopEdit(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        $workshop->name = $request->name;
        $workshop->code = $request->code;
        $workshop->description = $request->description;
        $workshop->save();

        return response()->json(['workshop' => $workshop]);
    }

    public function workshopDelete(Workshop $workshop)
    {
        $workshop->delete();

        return response()->json(['message' => 'deleted']);
    }
}
