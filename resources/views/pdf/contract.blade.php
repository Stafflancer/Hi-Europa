<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<h1>Contract Nº {{$contract['number']}}</h1>
<table>
    <tr>
        <td>ContractID    </td>
        <td>{{$contract['id']}}</td>
    </tr>
    <tr>
        <td>DevisID    </td>
        <td>{{$contract['user']['quotation'] ? $contract['user']['quotation']['id'] : ""}}</td>
    </tr>
    <tr>
        <td>Code Postal    </td>
        <td>{{ $contract['user']['postal_code'] }}</td>
    </tr>
    <tr>
        <td>Address    </td>
        <td>{{ $contract['additional_address'] }}</td>
    </tr>
    <tr>
        <td>Comp. Adress    </td>
        <td>{{ $contract['exact_address'] }}</td>
    </tr>
    <tr>
        <td>City    </td>
        <td>{{ $contract['city'] }}</td>
    </tr>
    <tr>
        <td>Nom    </td>
        <td>{{ $contract['user']['first_name'] }}</td>
    </tr>
    <tr>
        <td>Prénom    </td>
        <td>{{ $contract['user']['last_name'] }}</td>
    </tr>
    <tr>
        <td>Date de naissance    </td>
        <td>{{ $contract['user']['birthday'] }}</td>
    </tr>
    <tr>
        <td>Téléphone    </td>
        <td>{{ $contract['user']['phone_number'] }}</td>
    </tr>
    <tr>
        <td>Téléphone fixe    </td>
        <td>{{ $contract['user']['landline_phone'] }}</td>
    </tr>
    <tr>
        <td>ResidentID    </td>
        <td>
            @foreach($contract['residents'] as $resident)
                <p>{{$resident->id}}</p>
            @endforeach
        </td>
    </tr>
    <tr>
        <td>Date entrée    </td>
        <td>{{ $contract['contract_start_date'] }}</td>
    </tr>
    <tr>
        <td>Date fin</td>
        <td>{{ $contract['contract_expiration_date'] }}</td>
    </tr>
    <tr>
        <td>Prix / mois    </td>
        <td>{{ $contract['user']['quotation']['cost_month'] }}</td>
    </tr>
    <tr>
        <td>Prélèvement    </td>
        <td>{{ $contract['duration_contract'] }}</td>
    </tr>
    <tr>
        <td>Créé le    </td>
        <td>{{ $contract['created_at'] }}</td>
    </tr>
</table>
</body>
</html>
