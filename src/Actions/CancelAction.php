<?php

namespace TaskForce\Actions;

use TaskForce\Models\Task;

class CancelAction extends AbstractAction
{
    const PUBLIC_NAME = 'Cancel';
    const NAME = 'cancel';

    public static function getPublicName(): string
    {
        return self::PUBLIC_NAME;
    }

    public static function getName(): string
    {
        return self::NAME;
    }

    public static function checkPermission(Task $task, int $userId): bool
    {
        if ($task->getStatus() !== Task::STATUS_NEW) {
            return false;
        }
        if ($userId !== $task->getCustomerId()) {
            return false;
        }

        return true;
    }

}
