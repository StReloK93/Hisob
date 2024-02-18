<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;
use App\Models\EmployeProduct;
use Storage;

class ReportController extends Controller
{

    public function create_file($filename, $currentDate){
        return Excel::store(new EmployeProductsExport($currentDate), "public/".$filename);
        // return Excel::download(new EmployeProductsExport, "Muddati o'tgan tovarlar.xlsx");
    }


    public function store(Request $request){
        $now = now()->timestamp;
        $filename = "$request->name$now.xlsx";
        $this->create_file($filename, now());


        return Report::create([
            'name' => $request->name,
            'confirmed' => false,
            'file_source' => $filename,
            'report_type_id' => $request->report_type_id,
            'created_at' => now(),
        ]);

    }


    public function reportsByType($report_type_id){
        return Report::where('report_type_id', $report_type_id)->get();
    }


    public function confirmed($id){
        $report = Report::find($id);
        $date = $report->created_at;
    }

    public function destroy($id){
        $report = Report::find($id);
        Storage::delete("public/$report->file_source");
        return $report->delete();
    }
}
