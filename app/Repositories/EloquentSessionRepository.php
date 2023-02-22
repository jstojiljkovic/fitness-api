<?php

namespace App\Repositories;

use App\Enums\SessionStatusEnum;
use App\Helpers\ApplicationHelper;
use App\Http\Resources\ScheduledBlockResource;
use App\Http\Resources\SessionResource;
use App\Interfaces\Repositories\SessionRepositoryInterface;
use App\Models\Session;

class EloquentSessionRepository implements SessionRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $session = Session::create($data);

        return SessionResource::make($session)->resolve();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $sessions = Session::all();

        return SessionResource::collection($sessions)->resolve();
    }

    /**
     * @return array
     */
    public function getJoined(): array
    {
        $sessions = Session::whereHas('users', function ($query) {
            $query->where('id', ApplicationHelper::activeUser());
        })->get();

        return SessionResource::collection($sessions)->resolve();
    }

    /**
     * @return array
     */
    public function getOwned(): array
    {
        $sessions = Session::where('user_id', ApplicationHelper::activeUser())
            ->get();

        return SessionResource::collection($sessions)->resolve();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function join(string $id): void
    {
        $session = Session::find($id);
        $session->users()->attach(ApplicationHelper::activeUser());
    }

    /**
     * @param string $id
     * @param string $status
     *
     * @return void
     */
    public function changeStatus(string $id, string $status): void
    {
        $session = Session::find($id);
        $session->update([ 'status' => $session ]);
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function update(string $id, array $data): array
    {
        $session = Session::find($id);
        $session->update($data);

        return SessionResource::make($session)->resolve();
    }

    /**
     * @param string $date
     * @param string $start
     * @param string $end
     *
     * @return bool
     */
    public function isScheduled(string $date, string $start, string $end): bool
    {
        return Session::where('date', $date)
            ->where('start', $start)
            ->where('end', $end)
            ->exists();
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function isJoined(string $id): bool
    {
        return Session::where('id', $id)
            ->whereHas('users', function ($query) {
                $query->where('id', ApplicationHelper::activeUser());
            })->exists();
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function get(string $id): array
    {
        $session = Session::find($id);

        return SessionResource::make($session)->resolve();
    }

    /**
     * @param string $workoutId
     * @param string $date
     *
     * @return array
     */
    public function getDailyScheduled(string $workoutId, string $date): array
    {
        $sessions = Session::where('date', $date)
            ->where('status', SessionStatusEnum::ACCEPTED)
            ->where('workout_id', $workoutId)
            ->get();

        return ScheduledBlockResource::collection($sessions)->resolve();
    }
}
