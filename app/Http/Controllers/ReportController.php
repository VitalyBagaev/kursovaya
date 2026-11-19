<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        return response()->json(Report::with(['productionBatch', 'user'])->get());
    }

    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $report = Report::create($data);
        $report->load(['productionBatch', 'user']);

        return response()->json($report, 201);
    }

    public function show(Report $report)
    {
        $report->load(['productionBatch', 'user']);
        return response()->json($report);
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->validated());
        $report->load(['productionBatch', 'user']);

        return response()->json($report);
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json(['message' => 'Отчёт удалён']);
    }
}
