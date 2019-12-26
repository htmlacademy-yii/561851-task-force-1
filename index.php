<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesForTransform = [
    '0' => [
        'file' => 'data/categories.csv',
        'handler' => 'TaskForce\Helpers\Handlers\CategoryImport',
        'type' => 'INSERT'
    ],
    '1' => [
        'file' => 'data/cities.csv',
        'handler' => 'TaskForce\Helpers\Handlers\CityImport',
        'type' => 'INSERT'
    ],
    '2' => [
        'file' => 'data/opinions.csv',
        'handler' => 'TaskForce\Helpers\Handlers\OpinionImport',
        'type' => 'INSERT'
    ],
    '3' => [
        'file' => 'data/profiles.csv',
        'handler' => 'TaskForce\Helpers\Handlers\ProfileImport',
        'type' => 'UPDATE'
    ],
    '4' => [
        'file' => 'data/users.csv',
        'handler' => 'TaskForce\Helpers\Handlers\UserImport',
        'type' => 'INSERT'
    ],
    '5' => [
        'file' => 'data/replies.csv',
        'handler' => 'TaskForce\Helpers\Handlers\ReplyImport',
        'type' => 'INSERT'
    ],
    '6' => [
        'file' => 'data/tasks.csv',
        'handler' => 'TaskForce\Helpers\Handlers\TaskImport',
        'type' => 'INSERT'
    ]
];

foreach ($filesForTransform as $arr) {
    $fileObj = new \TaskForce\Helpers\TransformCsvToSql($arr['file'], $arr['handler'], $arr['type']);
    $fileObj->transform();
}
