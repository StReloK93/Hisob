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
        $this->PositionProducts = collect(PositionProduct::whereRaw('TRY_CAST(expiration_date AS int) IS NOT NULL')
            ->get()->toArray());
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
        ->select('employe_id', 'product_id', 'position_id', 'nomenclature', 'price', 'date_of_receipt')
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

        $expiration = $this->PositionProducts->where('position_id', $data['position_id'])->where('product_id', $data['product_id'])->first();

        if (isset($expiration)) {
            $data['expiration_date'] = $expiration['expiration_date'];
        }
        else return [];

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