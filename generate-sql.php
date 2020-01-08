<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesForTransform = [
    [
        'file' => __DIR__ . '/data/categories.csv',
        'handler' => new TaskForce\Helpers\Handlers\CategoryImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => 'category'
    ],
    [
        'file' => __DIR__ . '/data/cities.csv',
        'handler' => new TaskForce\Helpers\Handlers\CityImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => 'city'
    ],
    [
        'file' => __DIR__ . '/data/users.csv',
        'handler' => new TaskForce\Helpers\Handlers\UserImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => 'user'
    ],
    [
        'file' => __DIR__ . '/data/profiles.csv',
        'handler' => new TaskForce\Helpers\Handlers\ProfileImport(),
        'sqlAction' => 'UPDATE',
        'sqlFileName' => 'profile'
    ],
    [
        'file' => __DIR__ . '/data/tasks.csv',
        'handler' => new TaskForce\Helpers\Handlers\TaskImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => 'task'
    ],
    [
        'file' => __DIR__ . '/data/opinions.csv',
        'handler' => new TaskForce\Helpers\Handlers\OpinionImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => 'opinion'
    ],
    [
        'file' => __DIR__ . '/data/replies.csv',
        'handler' => new TaskForce\Helpers\Handlers\ReplyImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => 'reply'
    ]
];

foreach ($filesForTransform as $arr) {
    $fileObj = new \TaskForce\Helpers\TransformCsvToSql($arr['file'], $arr['handler'], $arr['sqlAction']);
    $fileObj->transform($arr['sqlFileName']);
}
