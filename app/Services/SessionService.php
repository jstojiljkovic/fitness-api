<?php

namespace App\Services;

use App\Enums\SessionStatusEnum;
use App\Interfaces\Repositories\SessionRepositoryInterface;
use App\Interfaces\Services\SessionServiceInterface;
use Carbon\Carbon;

class SessionService implements SessionServiceInterface
{
    /**
     * @var SessionRepositoryInterface
     */
    protected SessionRepositoryInterface $sessionRepository;

    /**
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(SessionRepositoryInterface $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function storeIndividual(array $data): array
    {
        // TODO: Implement notifications so we can send them when someone schedule
        $this->isScheduledDateValid($data['date'], $data['start'], $data['end']);
        $data['used'] = 1;
        $session = $this->sessionRepository->store($data);
        $this->sessionRepository->join($session['id']);

        return $session;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function storeGroup(array $data): array
    {
        // TODO: Implement notifications so we can send them when someone schedule
        // TODO: Implement point system or subscription system
        $this->isScheduledDateValid($data['date'], $data['start'], $data['end']);
        $data['status'] = SessionStatusEnum::ACCEPTED;

        return $this->sessionRepository->store($data);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->sessionRepository->getAll();
    }

    /**
     * @param string $date
     * @param string $start
     * @param string $end
     *
     * @return void
     */
    private function isScheduledDateValid(string $date, string $start, string $end): void
    {
        abort_if(
            Carbon::createFromFormat('Y-m-d H:i', $date . $start)->isPast(),
            400,
            'You can\'t schedule session in the past time.'
        );

        abort_if(
            $this->sessionRepository->isScheduled($date, $start, $end),
            400,
            'Session with provided date, start and end time is already scheduled.'
        );
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function joinGroup(string $id): void
    {
        // TODO: Implement notifications so we can send them when someone schedule
        // TODO: Implement point system or subscription system
        abort_if(
            $this->sessionRepository->isJoined($id),
            400,
            'You have already joined this session.'
        );

        $session = $this->sessionRepository->get($id);

        abort_if(
            $session['capacity'] === $session['used'],
            400,
            'There is already a maximum users joined.'
        );

        $this->sessionRepository->join($id);
        $session['used']++;
        $this->sessionRepository->update($id, $session);
    }
}
