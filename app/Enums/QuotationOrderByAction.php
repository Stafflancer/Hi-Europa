<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

final class QuotationOrderByAction extends Enum
{
    private const ID = 'id';
    private const ROOM = 'room';
    private const LIVING_ROOM = 'living_room';
    private const LIBRARY = 'library';
    private const MEZZANINE = 'mezzanine';
    private const USER_ID = 'user_id';
    private const CONTRACT_ID = 'contract_id';
    private const UPDATED_AT = 'updated_at';
}

// echo strtoupper('mezzanine');
