<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static DownloadAction GET_IMA_USERS()
 * @method static DownloadAction GET_IMA_QUOTATIONS()
 * @method static DownloadAction GET_IMA_INTERVENTIONS()
 * @method static DownloadAction GET_WAKAM_RESILIATIONS()
 * @method static DownloadAction GET_WAKAM_RESIDENTS()
 * @method static DownloadAction GET_WAKAM_PROSPECTS()
 * @method static DownloadAction GET_WAKAM_USERS()
 * @method static DownloadAction GET_WAKAM_QUOTATIONS()
 * @method static DownloadAction GET_WAKAM_CONTRACTS()
 */
final class DownloadAction extends Enum
{
    private const GET_IMA_USERS = 'get_ima_users';
    private const GET_IMA_QUOTATIONS = 'get_ima_quotations';
    private const GET_IMA_INTERVENTIONS = 'get_ima_interventions';
    private const GET_WAKAM_RESILIATIONS = 'get_wakam_resiliations';
    private const GET_WAKAM_RESIDENTS = 'get_wakam_residents';
    private const GET_WAKAM_PROSPECTS = 'get_wakam_prospects';
    private const GET_WAKAM_USERS = 'get_wakam_users';
    private const GET_WAKAM_QUOTATIONS = 'get_wakam_quotations';
    private const GET_WAKAM_CONTRACTS = 'get_wakam_contracts';
}
