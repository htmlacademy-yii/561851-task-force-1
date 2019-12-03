<?php

namespace TaskForce\Models;

use TaskForce\Actions\CancelAction;

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

    public function __construct(int $employeeId, int $customerId, string $completionDate, string $status = self::STATUS_NEW)
    {
        $this->employeeId = $employeeId;
        $this->customerId = $customerId;
        $this->completionDate = $completionDate;
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

