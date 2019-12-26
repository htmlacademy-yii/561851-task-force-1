<?php


namespace TaskForce\Helpers\Handlers;


class OpinionImport extends CsvImport
{
    private static $tablename = 'opinion';

    public function correctedResults($row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'author_id' => rand(1, 20),
                'consumer_id' => rand(1, 20),
                'description' => $row[2],
                'task_id' => rand(1, 10),
                'rating' => $row[1],
                'created_at' => $row[0]
            ]
        ];
    }
}
