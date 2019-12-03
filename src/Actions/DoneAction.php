<?php

namespace TaskForce\Actions;

use TaskForce\Models\Task;

class DoneAction extends AbstractAction
{
    const PUBLIC_NAME = 'Done';
    const NAME = 'done';

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
        if ($userId !== $task->getCustomerId()) {
            return false;
        }

        return true;
    }

}
