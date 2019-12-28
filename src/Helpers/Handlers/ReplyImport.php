<?php


namespace TaskForce\Helpers\Handlers;


class ReplyImport extends CsvImport
{
    private static $tablename = 'reply';

    public function correctedResults(array $row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'author_id' => rand(1, 20),
                'task_id' => rand(1, 10),
                'description' => $row[2],
                'rating' => $row[1],
                'created_at' => $row[0]
            ]
        ];
    }
}
