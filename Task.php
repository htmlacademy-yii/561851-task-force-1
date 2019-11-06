<?php

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

    public function __construct($status = STATUS_NEW, $userRole = ROLE_CUSTOMER, $employeeId, $customerId, $completionDate)
    {
        $this->status = $status;
        $this->userRole = $userRole;
        $this->employeeId = $employeeId;
        $this->customerId = $customerId;
        $this->completionDate = $completionDate;
    }

    /**
     * Actions
     */
    public function cancel ($currentUserRole): string
    {

        assert($this->status === self::STATUS_NEW );
        assert($this->userRole === self::ROLE_CUSTOMER);

        $this->status = self::STATUS_CANCELLED;

        return $this->status;

    }


    public function respond ($currentUserRole): string
    {

        assert($this->status === self::STATUS_NEW );
        assert($currentUserRole === self::ROLE_EMPLOYEE );

        $this->status = self::STATUS_RESPONDED;

        return $this->status;

    }

    public function inProgress ($currentUserRole): string
    {

        assert($this->status === self::STATUS_NEW );
        assert($currentUserRole === self::ROLE_CUSTOMER );

        $this->status = self::STATUS_IN_PROGRESS;

        return $this->status;

    }

    public function done ($currentUserRole): string
    {

        assert($this->status === self::STATUS_IN_PROGRESS );
        assert($currentUserRole === self::ROLE_CUSTOMER );

        $this->status = self::STATUS_COMPLITED;

        return $this->status;

    }

    public function fail ($currentUserRole): string
    {

        assert($this->status === self::STATUS_IN_PROGRESS );
        assert($currentUserRole === self::ROLE_CUSTOMER );

        $this->status = self::STATUS_FAILED;

        return $this->status;

    }

    public function refuse ($currentUserRole): string
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
     * @return string
     */
    public function getUserRole(): string
    {
        return $this->userRole;
    }

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return mixed
     */
    public function getCompletionDate()
    {
        return $this->completionDate;
    }

}
