<?php

namespace TaskForce\Actions;

use TaskForce\Models\Task;

class RefuseAction extends AbstractAction
{
    const PUBLIC_NAME = 'Refuse';
    const NAME = 'refuse';

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
        if ($task->getStatus() !== Task::STATUS_IN_PROGRESS) {
            return false;
        }
        if ($userId !== $task->getEmployeeId()) {
            return false;
        }

        return true;
    }

}
