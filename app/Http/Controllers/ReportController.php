<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeProductsExport;
use App\Exports\HarakatExport;
use App\Exports\UmumiyMalumotlar;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;
use App\Models\EmployeProduct;
use App\Models\Employe;
use Auth;
use Storage;

class ReportController extends Controller
{
    public function umumiy_malumot(){
        return Excel::download(new UmumiyMalumotlar, "Hodimlar.xlsx");
    }

    public function muddati_utganlar($id){
        $report = Report::find($id);
        $created = Carbon::parse($report->created_at)->timestamp;
        $filename = "$report->name$created.xlsx";

        return Excel::download(new EmployeProductsExport($report->created_at, true, $report), $filename);
    }

    public function hali_amalda($id){
        $report = Report::find($id);
        $created = Carbon::parse($report->created_at)->timestamp;
        $filename = "$report->name$created.xlsx";

        return Excel::download(new EmployeProductsExport($report->created_at, false), $filename);
    }

    public function store(Request $request){
        $currentTime = now();
        if($request->report_type_id == 3){
            $filename = "$request->name$currentTime->timestamp.xlsx";
            $productIds = array_column($request->products, 'id');
            Excel::store(new HarakatExport($request->start, $request->end, $productIds), "public/".$filename);
        }

        return Report::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'confirmed' => false,
            'file_source' => $filename,
            'report_type_id' => $request->report_type_id,
            'created_at' => $currentTime,
        ])->fresh();
    }


    public function reportsByType($report_type_id){
        return Report::where('report_type_id', $report_type_id)->get();
    }

    public function destroy($id){
        $report = Report::find($id);
        Storage::delete("public/$report->file_source");
        return $report->delete();
    }

    public function successEmployeProducts($report_id){
        $report = Report::find($report_id);
        $targetDate = $report->created_at;
        $employes = Employe::accessOrganizations()->pluck('id');


        EmployeProduct::whereNotIn('expiration_date', ['до износа', 'дежурные'])
        ->whereIn('employe_id', $employes)
        ->whereRaw('DATEADD(month, CAST(expiration_date AS INT), date_of_receipt) < ?', [$targetDate])
        ->update([
            'date_write_off' => $targetDate,
            'toggle_write_off' => true,
            'report_id' => $report->id,
        ]);

        $report->confirmed = true;
        $report->save();
        return $report->fresh();
    }
}


