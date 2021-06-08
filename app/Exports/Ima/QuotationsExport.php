<?php

namespace App\Exports\Ima;

use App\Models\ImaQuotation;
use App\Models\ImaUser;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'ima_quotations.id' => 'DevisID',
        'ima_users.postal_code' => 'Code Postal', //Postal code
        'ima_quotations.problem_type' => 'Problématiques', //Problem type
        'ima_quotations.precision_one' => 'Précision 1',
        'ima_quotations.precision_two' => 'Précision 2',
        'ima_quotations.precision_tree' => 'Précision 3', //Precision 3
        'ima_quotations.intervention_date' => 'Jour intervention', // Intervention date
        'ima_quotations.start_time' => 'Heure intervention', // From what time?
        'ima_quotations.cost' => 'Tarif', // Cost
        'ima_quotations.ima_user_id' => 'UserID',
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        $ima_quotations = (new ImaQuotation)->getTable();
        $ima_users = (new ImaUser)->getTable();

        return DB::table($ima_quotations . ' AS ima_quotations')
            ->leftJoin($ima_users . ' AS ima_users', 'ima_users.id', '=', 'ima_quotations.ima_user_id')
            ->select(array_keys($this->columns))
            ->orderBy('id', 'desc'); //->dd();
    }
}
