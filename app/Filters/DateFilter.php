<?php

namespace App\Filters;

class DateFilter
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param $query
     * @param $date
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($query, $date): mixed
    {
        return $query->where('date', $date);
    }
}
