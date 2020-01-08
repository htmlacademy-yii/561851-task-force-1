<?php

require_once __DIR__ . '/vendor/autoload.php';

$filesForTransform = [
    [
        'file' => __DIR__ . '/data/categories.csv',
        'handler' => new TaskForce\Helpers\Handlers\CategoryImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' =>  __DIR__ . '/data/category.sql'
    ],
    [
        'file' => __DIR__ . '/data/cities.csv',
        'handler' => new TaskForce\Helpers\Handlers\CityImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => __DIR__ . '/data/city.sql'
    ],
    [
        'file' => __DIR__ . '/data/users.csv',
        'handler' => new TaskForce\Helpers\Handlers\UserImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => __DIR__ . '/data/user.sql'
    ],
    [
        'file' => __DIR__ . '/data/profiles.csv',
        'handler' => new TaskForce\Helpers\Handlers\ProfileImport(),
        'sqlAction' => 'UPDATE',
        'sqlFileName' => __DIR__ . '/data/profile.sql'
    ],
    [
        'file' => __DIR__ . '/data/tasks.csv',
        'handler' => new TaskForce\Helpers\Handlers\TaskImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => __DIR__ . '/data/task.sql'
    ],
    [
        'file' => __DIR__ . '/data/opinions.csv',
        'handler' => new TaskForce\Helpers\Handlers\OpinionImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => __DIR__ . '/data/opinion.sql'
    ],
    [
        'file' => __DIR__ . '/data/replies.csv',
        'handler' => new TaskForce\Helpers\Handlers\ReplyImport(),
        'sqlAction' => 'INSERT',
        'sqlFileName' => __DIR__ . '/data/reply.sql'
    ]
];

foreach ($filesForTransform as $arr) {
    $fileObj = new \TaskForce\Helpers\TransformCsvToSql($arr['file'], $arr['handler'], $arr['sqlAction']);
    $fileObj->transform($arr['sqlFileName']);
}
