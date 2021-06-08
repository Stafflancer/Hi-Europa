<?php

namespace App\Exports\Wakam;

use App\Models\Contract;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectsExport implements FromQuery, WithHeadings
{
    use Exportable;

    //  prospects.contract_id -> contracts.id -> contracts.user_id -> users.id
    protected $columns = [
        'prospects.id' => 'ProspectID',
        'users.postal_code' => 'Code Postal', //Postal code
        'email' => 'Email',
        'prospects.residency_type' => 'Type logement', //Residency Type
        'prospects.prospect_type' => 'Type Prospect', //Propect type,
        'prospects.residence_type' => 'Type résidence', //Residence type
        'prospects.floor' => 'Etage', // Floor
        'prospects.surface' => 'Surface', //Surface
        'prospects.number_rooms' => 'Pièces', //Number of rooms
        'prospects.got_insurance' => 'Assuré', //Got insurance?
        'prospects.live_there_time' => 'Historique', //How long live there?
        'prospects.insured_time' => 'Durée', //How long got insured?
        'users.receive_info' => 'Info Hi Europa', //Receive info from Hi europa?
        'prospects.created_at' => 'Créé le', //Date creation
        'prospects.created_at' => 'à', //Time creation
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        $prospects = (new Prospect)->getTable();
        $contracts = (new Contract)->getTable();
        $users = (new User)->getTable();

        return DB::table($prospects . ' AS prospects')
            ->join($contracts . ' AS contracts', 'contracts.id', '=', 'prospects.contract_id')
            ->join($users . ' AS users', 'users.id', '=', 'contracts.user_id')
            ->select(array_keys($this->columns))
            ->orderBy('prospects.id', 'desc');
    }
}
