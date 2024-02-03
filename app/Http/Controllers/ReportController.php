<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeProductsExport;
use Maatwebsite\Excel\Facades\Excel;


// table_number
// fish
// tovar nomi
// tovar nomenklaturasi
// tovar narxi
// tovarni muddati tugagan kuni
class ReportController extends Controller
{

    public function export(){
        return Excel::download(new EmployeProductsExport, "Muddati o'tgan tovarlar.xlsx");
    }
    
}
