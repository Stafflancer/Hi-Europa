<?php

namespace App\Exports\Wakam;

use App\Models\Contract;
use App\Models\Quotation;
use App\Models\Resident;
use App\Models\Resiliation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContractsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'contracts.id' => 'ContratID',
        'contracts.user_id' => 'UserID',
        'quotations.contract_id' => 'DevisID',
        'quotations.postal_code' => 'Code Postal',
        'contracts.exact_address' => 'Adresse',
        'contracts.additional_address' => 'Comp. Adresse', // Comp. Adrdess
        'contracts.city' => 'Ville', // City
        'contracts.dependance_postal_code' => 'Dependance Code Postal', // Code Postal of dependency
        'contracts.dependance_adresse' => 'Dependance Adresse', // Address of dependency
        'contracts.dependance_comp_adresse' => 'Dependance Comp. Adresse', // Com. address of dependency
        'contracts.dependance_city' => 'Dependance Ville', // City of dependency
        'CASE users.gender WHEN "female" THEN "Madame" WHEN "male" THEN "Monsieur" ELSE "" END AS title' => 'Titre', // Title
        'users.last_name' => 'Nom', // Last Name
        'users.first_name' => 'Prénom', // First Name
        'users.birthday' => 'Date de naissance', // Birthday
        'users.phone_number' => 'Téléphone', // Mobile
        'users.landline_phone' => 'Téléphone fixe', // Phone
        'GROUP_CONCAT(DISTINCT(residents.id)) as ResidentsIds' => 'ResidentIDs',
        'contracts.contract_start_date' => 'Date entrée', // Start date
        'contracts.contract_expiration_date' => 'Date fin', // End date
        'quotations.cost_month' => 'Prix / mois', // Price / month
        'contracts.duration_contract' => 'Prélèvement', // Date transfert
        'contracts.pdf' => 'PDFs',
        'contracts.created_at' => 'Créé le', // Date creation
        'contracts.created_at' => 'à', // Time creation
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    /**
     *
     * @see \App\Enums\DownloadAction get_wakam_contracts
     */
    public function query()
    {
        $users = (new User)->getTable();
        $quotations = (new Quotation)->getTable();
        $contracts = (new Contract)->getTable();
        $residents = (new Resident)->getTable();

        return DB::table($contracts . ' AS contracts')
            ->leftJoin($users . ' AS users', 'users.id', '=', 'contracts.user_id')
            ->leftJoin($residents . ' AS residents', 'contracts.id', '=', 'residents.contract_id')
            ->leftJoin($quotations . ' AS quotations', 'quotations.contract_id', '=', 'contracts.id')
            ->select(DB::raw(join(',', array_keys($this->columns))))
            ->groupBy('contracts.id')
            ->orderBy('contracts.id', 'desc'); //->dd();
    }
}
