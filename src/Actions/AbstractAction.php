<?php

namespace TaskForce\Actions;

use TaskForce\Models\Task;

abstract class AbstractAction
{
	/**
	 * Get action public name
	 *
	 * @return string
	 */
    abstract public static function getPublicName () : string;

	/**
	 * Get action name
	 *
	 * @return string
	 */
    abstract public static function getName () : string;

	/**
	 * Check permission
	 */
	abstract public static function checkPermission (Task $task, int $userId) : bool;
}
