<?php

class Task {
	
	/**
	 * $status  - new, cancelled, in_work, complited, failed
	 */
	private $status = 'new';
	
	/**
	 * $user_permission - customer, player
	 */
	private $user_permission = 'customer';
	
	private $description = '';

	/* Больше для подсказки */
	private $customer_actions = [
		'new' => 'create_task_action',
		'cancelled' => 'cancel_task_action',
		'in_work' => 'in_work_task_action',
		'complited' => 'complit_task_action'
	];	
	
	private $player_actions = [
		'new' => 'take_task_action',
		'in_work' => 'decline_task_action'
	];
	
	public function __construct ($status, $user_permission) {
        $this->setStatus($status);

        //user_permissions?
	}
	
	/**
	 * Get status
	 */
	public function getStatus () {
		return $this->status;
	}
	
	/**
	 * Set status
	 */
	public function setStatus ($status) {
		$this->status = $status;
	}
	
	/**
	 * Get description
	 */
	public function getDescription () {
		return $this->description;
	}
	
	/**
	 * Set description
	 */
	public function setDescription ($description) {
		$this->description = $description;
	}
}