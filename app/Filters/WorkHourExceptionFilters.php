<?php

namespace App\Filters;

use App\Http\Requests\WorkHourException\StoreWorkHourExceptionRequest;

class WorkHourExceptionFilters
{
    protected array $filters = [ 'date' => DateFilter::class ];

    /**
     * @param $query
     * @param array $data
     *
     * @return mixed
     */
    public function apply($query, array $data): mixed
    {
        foreach ($data as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }

        return $query;
    }
}
