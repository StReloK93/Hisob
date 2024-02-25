<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeProductsExport;
use App\Exports\HarakatExport;
use App\Exports\UmumiyMalumotlar;


use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;
use App\Models\EmployeProduct;
use App\Models\Employe;
use Auth;
use Storage;

class ReportController extends Controller
{

    public function create_hisobot($filename, $currentDate, $old){
        return Excel::store(new EmployeProductsExport($currentDate, $old), "public/".$filename);
    }
    public function create_harakat($filename, $startDate, $endDate, $productTypes){
        return Excel::store(new HarakatExport($startDate, $endDate, $productTypes), "public/".$filename);
    }

    public function umumiy_malumot(){
        return Excel::download(new UmumiyMalumotlar, "Hodimlar.xlsx");
    }

    public function store(Request $request){
        $now = now()->timestamp;
        $filename = "$request->name$now.xlsx";
        if($request->report_type_id == 1 || $request->report_type_id == 2){
            $this->create_hisobot($filename, now(), $request->old);
        }
        elseif($request->report_type_id == 3){
            $productIds = array_column($request->products, 'id');
            $this->create_harakat($filename, $request->start, $request->end, $productIds);
        }
        
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

    public function destroy($id){
        $report = Report::find($id);
        Storage::delete("public/$report->file_source");
        return $report->delete();
    }

    public function successEmployeProducts($report_id){
        $report = Report::find($report_id);
        $report->confirmed = true;
        $report->save();
        $organizations = Auth::user()->organizations->pluck('organizations_id');
        $employes = Employe::whereIn('organization_id', $organizations)->pluck('id');
        EmployeProduct::whereIn('employe_id', $employes)->update([
            'date_write_off' => null,
            'toggle_write_off' => false,
            'report_id' => null,
        ]);

        return $report->fresh();
    }
}
