<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

final class ContractOrderByAction extends Enum
{
    private const ID = 'id';
    private const USER_ID = 'user_id';
    private const QUOTATION_ID = 'quotation_id';
    private const UPDATED_AT = 'updated_at';
}

// echo strtoupper('quotation_id');
