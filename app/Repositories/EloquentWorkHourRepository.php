<?php

namespace App\Repositories;

use App\Constants\WorkHourConstant;
use App\Helpers\ApplicationHelper;
use App\Http\Resources\WorkHourResource;
use App\Interfaces\Repositories\WorkhourRepositoryInterface;
use App\Models\WorkHour;
use Illuminate\Support\Str;

class EloquentWorkHourRepository implements WorkHourRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        foreach ($data as $key => $item) {
            $data[$key]['id'] = Str::uuid();
            $data[$key]['user_id'] = ApplicationHelper::activeUser();
            $data[$key]['organisation_id'] = ApplicationHelper::activeOrganisation();
        }

        WorkHour::insert($data);

        $workHours = $this->get();

        return WorkHourResource::collection($workHours)->resolve();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $workHours = WorkHour::where('user_id', ApplicationHelper::activeUser())->get();

        return WorkHourResource::collection($workHours)->resolve();
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return WorkHour::where('user_id', ApplicationHelper::activeUser())
            ->where('id', $id)->exists();
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $workHour = WorkHour::where('user_id', ApplicationHelper::activeUser())
            ->where('id', $id)->first();
        $workHour->update($data);

        return WorkHourResource::make($workHour)->resolve();
    }

    /**
     * @return bool
     */
    public function created(): bool
    {
        $workHours = WorkHour::where('user_id', ApplicationHelper::activeUser())
            ->whereIn('id', WorkHourConstant::DAYS_IN_WEEK)->count();

        return count(WorkHourConstant::DAYS_IN_WEEK) === $workHours;
    }
}
