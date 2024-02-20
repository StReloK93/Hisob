<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;
use App\Models\EmployeProduct;
use App\Models\Employe;
use Auth;
use Storage;

class ReportController extends Controller
{

    public function create_file($filename, $currentDate, $old){
        return Excel::store(new EmployeProductsExport($currentDate, $old), "public/".$filename);
        // return Excel::download(new EmployeProductsExport, "Muddati o'tgan tovarlar.xlsx");
    }


    public function store(Request $request){
        $now = now()->timestamp;
        $filename = "$request->name$now.xlsx";
        $this->create_file($filename, now(), $request->old);

        
        $report = Report::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'confirmed' => false,
            'file_source' => $filename,
            'report_type_id' => $request->report_type_id,
            'created_at' => now(),
        ]);

        return $report->fresh();

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

    public function successEmployeProducts(){

        $organizations = Auth::user()->organizations->pluck('organizations_id');
        $employes = Employe::whereIn('organization_id', $organizations)->pluck('id');
        return EmployeProduct::whereIn('employe_id', $employes)->update([
            'date_write_off' => null,
            'toggle_write_off' => false,
        ]);
    }
}
