<?php

namespace App\LugCE;

/**
 * Class Definition
 * @package App\Moebius
 */
final class Definition
{
    /**
     * API Error Messages
     */
    const INVALID_API_KEY   = 'API KEY IS NOT VALID';
    const MISSING_API_KEY   = 'API KEY IS MISSING';
    const WRONG_PARAM       = 'Wrong Parameter received';

    /**
     * USER LEVEL
     */
    const REPORTER  = 1;
    const DOGHOUSE  = 2;
    const LAW       = 3;

    /**
     * Report Status
     */
    const PENDING = 1;
    const WORKING = 2;
    const CLOSED  = 3;
    const DELETED = 4;

    /**
     * Report Type
     */
    const BAD_CONDITION = 1;
    const ABANDONED     = 2;
    const STRAY         = 3;

}