<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\EmployeProduct;
use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
class EmployeProductsExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths
{
    private $old, $currentDate, $report;
    public function __construct($currentDate, $old , $report = null)
    {
        $this->old = $old;
        $this->currentDate = $currentDate;
        $this->report = $report;
    }

    public function collection()
    {
        $report = $this->report;
        $employes = Employe::accessOrganizations()->pluck('id')->all();
        $collect = EmployeProduct::whereNotIn('expiration_date', ['до износа', 'дежурные'])
        ->whereIn('employe_id', $employes)
        ->when(isset($this->report) && $this->report->confirmed, function ($query) use($report) {
            return $query->where('report_id', $report->id);
        })
        ->when(isset($this->report) && $this->report->confirmed == false || $this->report == null , function ($query) {
            return $query->where('toggle_write_off', 0);
        })
        ->with(['employe'])
        ->get();

        $collect->transform(function ($coll) {
            $coll->date_of_receipt = $coll->date_of_receipt->format('Y-m-d');
            return $coll;
        });

        return $collect;
    }


    public function map($row): array
    {
        $data = $row->getAttributes();

        if(isset($row->product)) $data['product'] = $row->product->name;
        else $data['product'] = null;

        $endDate = Carbon::parse($data['date_of_receipt'])->addMonths($data['expiration_date']);

        if(($this->currentDate < $endDate) == $this->old) {
            return [];
        }

        return [
            $row->employe->table_number,
            $row->employe->name,
            $data['product'],
            $data['nomenclature'],
            $data['price'],
            $data['expiration_date'],
            $data['date_of_receipt'],
            $endDate->format('Y-m-d')
        ];
    }

    public function headings(): array
    {
        // Метод headings остается таким же
        return [
            'Tabel raqami',
            'FISH',
            'Mahsulot nomi',
            'Nomenklatura',
            'Narxi',
            'Muddati',
            'Topshirilgan sana',
            'Yaroqlilik muddati',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 32,
            'C' => 44,
            'D' => 13,
            'E' => 11,
            'G' => 16,
        ];
    }
}
