<?php

namespace App\Exports;

use App\Models\Employe;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
class UmumiyMalumotlar implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnWidths
{
    public function headings(): array
    {
        // Метод headings остается таким же
        return [
            'Tabel raqami',
            'FISH',
            'Ish joyi',
            'Hujjatdagi lavozimi',
            'Lavozime(Kasbi)',
            'Ishga kirgan sana',
            'Buyi',
            "Bosh o'lchami",
            "Kiyim o'lchami",
            "Oyoq kiyim o'lchami",
            "Jinsi",
        ];
    }


    public function collection()
    {
        $organizations = Auth::user()->organizations->pluck('organizations_id');
        $employes = Employe::with('position')->whereIn('organization_id', $organizations)->get();
        foreach ($employes as $key => $employe) {
            $employes[$key]->organization_name  = $employe->organization->short_name;
            $employes[$key]->position_name = $employe->position[0]->position->name;
        }
        return $employes;
    }

    public function map($row): array
    {
        $data = $row->getAttributes();
        return [
            $data['table_number'],
            $data['name'],
            $data['organization_name'],
            $data['position_name'],
            $data['profession'],
            $data['hiring_date'],
            $data['heigth'],
            $data['size_cloth'],
            $data['size_head'],
            $data['size_shoes'],
            $data['gender'],
        ];
    }

    
    public function columnWidths(): array
    {
        return [
            'D' => 72,
        ];
    }
}
