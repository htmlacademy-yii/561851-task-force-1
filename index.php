<?php

require_once __DIR__ . '/vendor/autoload.php';

use TaskForce\Models\Task as Task;

$completion = new DateTime();

try {
    $task = new Task(1,2, $completion->setTimestamp(1575914452));
} catch (\TaskForce\Exceptions\CheckCompletionDateException $e) {
    echo $e->getMessage();
} catch (\TaskForce\Exceptions\CheckStatusException $e) {
    echo $e->getMessage();
}


$cancel = \TaskForce\Actions\CancelAction::checkPermission($task, 2);

if ($cancel) {
    echo 'success';
} else {
    echo 'fail';
}
