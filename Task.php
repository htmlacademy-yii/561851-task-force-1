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

    private static $avaibleStatuses = [
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
    const CUSTOMER = 'customer';
    const PLAYER = 'player';

    /**
     * Object fields
     */
    private $status = self::STATUS_NEW;
    private $userRole = self::CUSTOMER;
    private $playerId;
    private $customerId;
    private $completionDate;

    /**
     * Actions
     */
    public function cancel ()
    {

        assert($this->status == self::STATUS_NEW && $this->userRole == self::CUSTOMER);

        return $this->status = self::STATUS_CANCELLED;

    }


    public function respond ()
    {

        assert($this->status == self::STATUS_NEW && $this->userRole == self::PLAYER );

        return $this->status = self::STATUS_RESPONDED;

    }

    public function inProgress ()
    {

        assert($this->status == self::STATUS_NEW && $this->userRole == self::CUSTOMER );

        return $this->status = self::STATUS_IN_PROGRESS;

    }

    public function done ()
    {

        assert($this->status == self::STATUS_IN_PROGRESS && $this->userRole == self::CUSTOMER );

        return $this->status = self::STATUS_COMPLITED;

    }

    public function fail ()
    {

        assert($this->status == self::STATUS_IN_PROGRESS && $this->userRole == self::CUSTOMER );

        return $this->status = self::STATUS_FAILED;

    }

    public function refuse ()
    {

        assert($this->status == self::STATUS_IN_PROGRESS && $this->userRole == self::PLAYER );

        return $this->status = self::STATUS_NEW;

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getUserRole(): string
    {
        return $this->userRole;
    }

    /**
     * @param string $userRole
     */
    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }

    /**
     * @return mixed
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @param mixed $playerId
     */
    public function setPlayerId($playerId): void
    {
        $this->playerId = $playerId;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getCompletionDate()
    {
        return $this->completionDate;
    }

    /**
     * @param mixed $completionDate
     */
    public function setCompletionDate($completionDate): void
    {
        $this->completionDate = $completionDate;
    }
}
