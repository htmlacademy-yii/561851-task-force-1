<?php

require_once __DIR__ . '/vendor/autoload.php';

use TaskForce\Models\Task as Task;

$completion = new DateTime('2019-12-11 01:00:52');

try {
    $task = new Task(1,2, $completion);
} catch (\TaskForce\Exceptions\InvalidCompletionDateException $e) {
    echo $e->getMessage();
} catch (\TaskForce\Exceptions\InvalidStatusException $e) {
    echo $e->getMessage();
}


$cancel = \TaskForce\Actions\CancelAction::checkPermission($task, 2);

if ($cancel) {
    echo 'success';
} else {
    echo 'fail';
}
