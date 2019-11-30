<?php

namespace TaskForce\AbstractClasses;

abstract class AbstractAction
{

	/**
	 * Action public name
	 *
	 * @type string
	 */
	public $actionPublicName;

	/**
	 * Action name
	 *
	 * @type string
	 */
	public $actionName;

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
    abstract public static function getName() : string;

	/**
	 * Check permission
	 */
	abstract public static function checkPermision (int $id_customer, int $id_employee) : boolean;
}
