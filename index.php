<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesForTransform = [
    'data/categories.csv',
    'data/cities.csv',
    'data/opinions.csv',
    'data/profiles.csv',
    'data/replies.csv',
    'data/tasks.csv',
    'data/users.csv'
];

foreach ($filesForTransform as $file) {
    $fileObj = new \TaskForce\Helpers\TransformCsvToSql($file);
    $columns = $fileObj->getColumns();
    $fileObj->transform($columns);
}
