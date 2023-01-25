<?php

namespace App\Helpers;

class ApplicationHelper
{
    /**
     * @return string
     */
    public static function activeOrganisation(): string
    {
        return Auth()->user()->organisation_id;
    }

    /**
     * @return string
     */
    public static function activeUser(): string
    {
        return Auth()->user()->id;
    }
}
