<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\ProductionBatch;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportAll()
    {
        $reports = Report::with(['productionBatch', 'user'])->orderBy('created_at', 'desc')->get();

        return response()->json(['reports' => $reports]);
    }

    public function reportGet(Report $report)
    {
        $report->load(['productionBatch', 'user']);

        return response()->json(['report' => $report]);
    }

    public function reportAdd(StoreReportRequest $request)
    {
        $batch = ProductionBatch::where('id', $request->production_batch_id)->first();

        if ($batch) {
            if (($request->accepted_quantity + $request->defective_quantity) > $batch->quantity_produced) {
                return response()->json(['errors' => 'Сумма годных и брака больше количества изделий в партии'], 422);
            }

            $report = new Report;
            $report->production_batch_id = $request->production_batch_id;
            $report->user_id = Auth::user()->id;
            $report->title = $request->title;
            $report->content = $request->content;
            $report->accepted_quantity = $request->accepted_quantity;
            $report->defective_quantity = $request->defective_quantity;
            $report->save();

            if ($request->defective_quantity > 0) {
                $batch->status = 'есть брак';
            } else {
                $batch->status = 'принята';
            }
            $batch->save();

            return response()->json(['report' => $report], 201);
        } else {
            return response()->json(['errors' => 'Партия не найдена'], 404);
        }
    }

    public function reportEdit(UpdateReportRequest $request, Report $report)
    {
        $report->title = $request->title;
        $report->content = $request->content;
        $report->accepted_quantity = $request->accepted_quantity;
        $report->defective_quantity = $request->defective_quantity;
        $report->save();

        return response()->json(['report' => $report]);
    }

    public function reportDelete(Report $report)
    {
        $report->delete();

        return response()->json(['message' => 'deleted']);
    }
}
