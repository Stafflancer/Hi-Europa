<?php

namespace App\Exports\Wakam;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'quotations.id' => 'DevisID',
        'quotations.user_id' => 'UserId',
        'users.last_name' => 'Nom', // Family name
        'users.first_name' => 'Prénom', // First name
        'users.postal_code' => 'Code Postal', //Postal code
        'quotations.type_accommodation' => 'Type logement', // Type logement
        'quotations.prospect_type' => 'Type prospect', // Prospect type
        'quotations.type_residence' => 'Type résidence', // residence type
        'quotations.apartment_floor' => 'Etage',
        'quotations.apartment_surface' => 'Surface (m2)',
        'quotations.room' => 'Pièces', // umber of rooms
        'quotations.insured' => 'Assuré', // Got insurance?
        'quotations.contract_id' => 'Résiliation', // Résiliation
        'quotations.franchise' => 'Franchise (€)', // Deductible
        'quotations.furniture_capital' => 'Capital mobilier (€)', // Furniture capital
        'quotations.furniture_two_years_old' => 'Valeur à neuf', // Value of furnitures less than 2y old
        'quotations.total_value_furniture_400' => 'Objets valeur 400 (€)', // Total value of furnitures with more than 400 euros value
        'quotations.total_value_furniture_1800' => 'Objets valeur 1800(€)', // Total value of furnitures with more than 1800 euros value
        'quotations.estimated_coverage' => 'Obj. valeur. est. (€)', // Couvertue estimée
        'quotations.option_glass' => 'Bris / San / Elec', // Option glass break / sanitary / electricity
        'quotations.option_thief' => 'Vol Vandalisme', // Option thief
        'quotations.option_mobile' => 'Aff. nomades co', // Option connected mobile objects
        'quotations.school_insurance' => 'Ass. scolaire', //School insurance
        'quotations.dependencies' => 'Dépendences', // Dépendences
        'quotations.cost_month' => 'Prix / mois (€)', //Cost / month
        'users.receive_info' => 'Info Hi Europa', // ReReceive info from Hi europa?
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        $users = (new User)->getTable();
        $quotations = (new Quotation)->getTable();

        return DB::table($quotations . ' AS quotations')
            ->leftJoin($users . ' AS users', 'users.id', '=', 'quotations.user_id')
            ->select(array_keys($this->columns))
            ->orderBy('quotations.id', 'desc');
    }
}
