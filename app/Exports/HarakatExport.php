<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\EmployeProduct;
use App\Models\PositionProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class HarakatExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    private $PositionProducts;
    private $endDate;
    private $startDate;
    private $productTypes;

    public function __construct($startDate, $endDate, $productTypes)
    {
        $this->startDate = $startDate;
        $this->productTypes = $productTypes;
        $this->endDate = $endDate;
    }
    public function headings(): array
    {
        // Метод headings остается таким же
        return [
            'Tabel raqami',
            'FISH',
            'Buyi',
            "Kiyim o'lchami",
            "Bosh o'lchami",
            "Oyoq kiyim o'lchami",
            'Mahsulot nomi',
            'Nomenklatura',
            'Narxi',
            'Muddati',
            'Topshirilgan sana',
            'Yaroqlilik muddati',
        ];
    }


    public function collection()
    {
        $collect = EmployeProduct::whereIn('product_id', $this->productTypes)
        ->whereNotIn('expiration_date', ['до износа', 'дежурные'])
        ->select('employe_id', 'product_id', 'position_id', 'nomenclature', 'price', 'date_of_receipt', 'expiration_date')
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

        $endDate = Carbon::parse($data['date_of_receipt'])->add($data['expiration_date'], 'month');

        if($this->startDate < $endDate && $this->endDate > $endDate) {
            return [
                $row->employe->table_number,
                $row->employe->name,
                $row->employe->heigth,
                $row->employe->size_cloth,
                $row->employe->size_head,
                $row->employe->size_shoes,
                $data['product'],
                $data['nomenclature'],
                $data['price'],
                $data['expiration_date'],
                $data['date_of_receipt'],
                $endDate->format('Y-m-d')
            ];
        }
        else{
            return [];
        }

    }
}
