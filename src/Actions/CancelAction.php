<?php

namespace TaskForce\Actions;

class CancelAction extends TaskForce\AbstractClasses\AvailableActionsAbstract
{
	const ACTION_PUBLIC_NAME = 'Отмена';

	/**
	 * Action public name
	 *
	 * @type string
	 */
	public $actionPublicName = self::ACTION_PUBLIC_NAME;

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
    public function getPublicName()
    {
		return self::$actionPublicName;
	}

	/**
	 * Get action name
	 *
	 * @return string
	 */
    public function getName()
    {

    }

	/**
	 * Check permission
	 */
	public function checkPermision (int $id_customer, int $id_employee) : boolean
    {

    }
}
