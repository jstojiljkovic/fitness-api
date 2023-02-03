<?php

namespace App\Constants;

final class WorkHourConstant
{
    /**
     * Following the MySQL conventions 1 is Sunday and 7 is Saturday
     */
    public const DAYS_IN_WEEK = [ 1, 2, 3, 4, 5, 6, 7 ];

    public const DAYS_IN_ENGLISH = [
        1 => 'Sunday',
        2 => 'Monday',
        3 => 'Tuesday',
        4 => 'Wednesday',
        5 => 'Thursday',
        6 => 'Friday',
        7 => 'Saturday',
    ];
}
