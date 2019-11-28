<?php

namespace TaskForce\Models;

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
     * Available actions
     */
    const ACTION_CANCEL = 'cancel';
    const ACTION_RESPOND = 'respond';
    const ACTION_IN_PROGRESS = 'inProgress';
    const ACTION_DONE = 'done';
    const ACTION_FAIL = 'fail';
    const ACTION_REFUSE = 'refuse';

    /**
     * Available user roles
     */
    const ROLE_CUSTOMER = 'customer';
    const ROLE_EMPLOYEE = 'employee';

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
     * Actions
     */
    public function cancel (string $currentUserRole): string
    {

        assert($this->status === self::STATUS_NEW );
        assert($currentUserRole === self::ROLE_CUSTOMER);

        $this->status = self::STATUS_CANCELLED;

        return $this->status;

    }


    public function respond (string $currentUserRole): string
    {

        assert($this->status === self::STATUS_NEW );
        assert($currentUserRole === self::ROLE_EMPLOYEE );

        $this->status = self::STATUS_RESPONDED;

        return $this->status;

    }

    public function inProgress (string $currentUserRole): string
    {

        assert($this->status === self::STATUS_NEW );
        assert($currentUserRole === self::ROLE_CUSTOMER );

        $this->status = self::STATUS_IN_PROGRESS;

        return $this->status;

    }

    public function done (string $currentUserRole): string
    {

        assert($this->status === self::STATUS_IN_PROGRESS );
        assert($currentUserRole === self::ROLE_CUSTOMER );

        $this->status = self::STATUS_COMPLITED;

        return $this->status;

    }

    public function fail (string $currentUserRole): string
    {

        assert($this->status === self::STATUS_IN_PROGRESS );
        assert($currentUserRole === self::ROLE_CUSTOMER );

        $this->status = self::STATUS_FAILED;

        return $this->status;

    }

    public function refuse (string $currentUserRole): string
    {

        assert($this->status === self::STATUS_IN_PROGRESS );
        assert($currentUserRole === self::ROLE_EMPLOYEE );

        $this->status = self::STATUS_NEW;

        return $this->status;

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

