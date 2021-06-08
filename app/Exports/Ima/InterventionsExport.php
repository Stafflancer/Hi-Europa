<?php

namespace App\Exports\Ima;

use App\Models\Intervention;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class InterventionsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'interventions.id' => 'InterventionID',
        'ima_quotations.id' => 'DevisID', // QuotationID
        'interventions.ima_user_id' => 'UserID',
        'ima_users.postal_code' => 'Code Postal', // Postal code
        'interventions.address' => 'Adresse',
        'interventions.comp_address' => 'Comp. adresse',
        'interventions.city' => 'Ville', // City
        'interventions.attendance_person' => 'Présence', // Attendance in person?
        'interventions.other_person_last_name' => 'Autre Nom', // Other person name
        'interventions.other_person_first_name' => 'Autre Prénom', // Other person first name
        'interventions.other_person_phone' => 'Autre téléphone', // Other person phone
        '' => 'Info Hi Europa', // Receive info from Hi europa?
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        return Intervention::query()->select(array_keys($this->columns))->orderBy('id', 'desc');
    }
}
