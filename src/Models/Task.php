<?php

namespace TaskForce\Models;

use TaskForce\Actions\CancelAction;
use TaskForce\Exceptions\InvalidCompletionDateException;
use TaskForce\Exceptions\InvalidStatusException;

class Task {

    /**
     * Available statuses
     */
    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_RESPONDED = 'responded';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLITED = 'complited';
    const STATUS_FAILED = 'failed';

    const ALL_STATUSES = [
        self::STATUS_NEW,
        self::STATUS_CANCELLED,
        self::STATUS_RESPONDED,
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLITED,
        self::STATUS_FAILED
    ];

    /**
     * Object fields
     */
    private $status = self::STATUS_NEW;
    private $employeeId;
    private $customerId;
    private $completionDate;

    public function __construct(int $employeeId, int $customerId, \DateTimeInterface $completionDate, string $status = self::STATUS_NEW)
    {
        $this->employeeId = $employeeId;
        $this->customerId = $customerId;
        $this->completionDate = $completionDate;

        if ($completionDate->getTimestamp() < time()) {
            throw new InvalidCompletionDateException('Date ' . $completionDate . ' incorrect.');
        }

        $this->completionDate = $completionDate;

        if (!in_array($status, self::ALL_STATUSES, true)) {
            throw new InvalidStatusException('Status ' . $status . ' not exist.');
        }

        $this->status = $status;

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function getCompletionDate(): string
    {
        return $this->completionDate;
    }

}

