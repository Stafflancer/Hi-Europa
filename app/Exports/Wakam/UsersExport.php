<?php

namespace App\Exports\Wakam;

use App\Models\Quotation;
use App\Models\Resiliation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'users.id' => 'UserId',
        'CASE users.gender WHEN "female" THEN "Madame" WHEN "male" THEN "Monsieur" ELSE "" END AS title' => 'Titre', // Title
        'users.last_name' => 'Nom', //Family name
        'users.first_name' => 'Prénom', //First name
        'users.email' => 'Email',
        'users.phone_number' => 'Téléphone', //Mobile
        'users.landline_phone' => 'Téléphone fixe', //Phone
        'users.birthday' => "Date d'anniversaire", //Birthday
        'users.postal_code' => 'Code Postal', //Postal code
        'users.address' => 'Adresse',
        'users.city' => 'Ville', //city
        'quotations.id' => 'DevisID', //QuotationID
        'quotations.contract_id' => 'ContratID', // ContractID
        'users.insurance_payed' => 'Pb. Prime', //Pb. Insurance payment, ["Oui", "Non"]
        'resiliations.id' => 'RésiliationID', //Resiliation
        'users.receive_info' => 'Info Hi Europa', //ReReceive info from Hi europa? ["Oui", "Non"]
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        $users = (new User)->getTable();
        $quotations = (new Quotation)->getTable();
        $resiliations = (new Resiliation)->getTable();

        return DB::table($users . ' AS users')
            ->leftJoin($quotations . ' AS quotations', 'quotations.user_id', '=', 'users.id')
            ->leftJoin($resiliations . ' AS resiliations', 'resiliations.user_id', '=', 'users.id')
            ->select(DB::raw(join(',', array_keys($this->columns))))
            ->orderBy('users.id', 'desc')->dd();
    }
}
