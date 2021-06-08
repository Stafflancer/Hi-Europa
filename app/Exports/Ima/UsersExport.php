<?php

namespace App\Exports\Ima;

use App\Models\ImaUser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $columns = [
        'id' => 'UserId',
        'title' => 'Titre',
        'prospect_type' => 'Type prospect',
        'last_name' => 'Nom',
        'first_name' => 'Prénom',
        'email' => 'Email',
        'phone_number' => 'Téléphone',
    ];

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function query()
    {
        // return DB::table('users')->select(array_keys($this->columns))->orderBy('id', 'desc');
        return ImaUser::query()->select(array_keys($this->columns))->orderBy('id', 'desc');
    }
}
