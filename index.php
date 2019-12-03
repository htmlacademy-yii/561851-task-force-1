<?php

require_once __DIR__ . '/vendor/autoload.php';

use TaskForce\Models\Task as Task;

$task = new Task(1,2,'123');

$cancel = \TaskForce\Actions\CancelAction::checkPermission($task, 2);
if ($cancel) {
    echo 'success';
} else {
    echo 'fail';
}
