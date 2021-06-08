<?php

namespace App\Exports\Wakam;

use App\Models\Contract;
use App\Models\Resiliation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ResiliationsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'resiliations.id' => 'ResiliationID',
        'contracts.id' => 'ContractID',
        'resiliations.moving_out' => 'Déménagement', //Moving out
        'resiliations.insurance_company_name' => 'Assureur', //Insurance company name
        'resiliations.subscription_date' => 'Date souscription', //Subscription date
        'users.first_name' => 'Prénom assuré', //First name insured person
        'users.last_name' => 'Nom assuré', //Family name insured person
        'contracts.number' => 'Numéro contrat', //Previous contract number
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        $resiliations = (new Resiliation)->getTable();
        $users = (new User)->getTable();
        $contracts = (new Contract)->getTable();

        return DB::table($users . ' AS users')
            ->join($resiliations . ' AS resiliations', 'users.id', '=', 'resiliations.user_id')
            ->join($contracts . ' AS contracts', 'users.id', '=', 'contracts.user_id')
            ->select(array_keys($this->columns))
            ->orderBy('resiliations.id', 'desc');
    }
}
