<?php

namespace App\Exports\Wakam;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ResidentsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'id' => 'ResidentID',
        'contract_id' => 'ContractID',
        'title' => 'Titre', // Title
        'last_name' => 'Nom', // Family name
        'first_name' => 'Prénom', // First name
        'birthday' => "Date d'anniversaire", // Birthday
        'status' => 'Statut', // Status
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        return Resident::query()->select(array_keys($this->columns))
            ->orderBy('id', 'desc');
    }
}
