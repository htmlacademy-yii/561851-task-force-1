<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesForTransform = [
    'data/category.csv',
    'data/city.csv',
    'data/opinion.csv',
    'data/reply.csv',
    'data/task.csv',
    'data/user.csv'
];

foreach ($filesForTransform as $file) {
    $fileObj = new \TaskForce\Helpers\TransformCsvToSql($file);
    $fileObj->transform();
}
