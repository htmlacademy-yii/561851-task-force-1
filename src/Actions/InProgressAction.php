<?php

namespace TaskForce\Actions;

use TaskForce\Models\Task;

class InProgressAction extends AbstractAction
{
    const PUBLIC_NAME = 'In progress';
    const NAME = 'inProgress';

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
