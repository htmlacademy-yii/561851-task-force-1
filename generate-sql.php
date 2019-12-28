<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesForTransform = [
    [
        'file' => __DIR__ . '/data/categories.csv',
        'handler' => new TaskForce\Helpers\Handlers\CategoryImport(),
        'type' => 'INSERT'
    ],
    [
        'file' => __DIR__ . '/data/cities.csv',
        'handler' => new TaskForce\Helpers\Handlers\CityImport(),
        'type' => 'INSERT'
    ],
    [
        'file' => __DIR__ . '/data/opinions.csv',
        'handler' => new TaskForce\Helpers\Handlers\OpinionImport(),
        'type' => 'INSERT'
    ],
    [
        'file' => __DIR__ . '/data/profiles.csv',
        'handler' => new TaskForce\Helpers\Handlers\ProfileImport(),
        'type' => 'UPDATE'
    ],
    [
        'file' => __DIR__ . '/data/users.csv',
        'handler' => new TaskForce\Helpers\Handlers\UserImport(),
        'type' => 'INSERT'
    ],
    [
        'file' => __DIR__ . '/data/replies.csv',
        'handler' => new TaskForce\Helpers\Handlers\ReplyImport(),
        'type' => 'INSERT'
    ],
    [
        'file' => __DIR__ . '/data/tasks.csv',
        'handler' => new TaskForce\Helpers\Handlers\TaskImport(),
        'type' => 'INSERT'
    ]
];

foreach ($filesForTransform as $arr) {
    $fileObj = new \TaskForce\Helpers\TransformCsvToSql($arr['file'], $arr['handler'], $arr['type']);
    $fileObj->transform();
}
