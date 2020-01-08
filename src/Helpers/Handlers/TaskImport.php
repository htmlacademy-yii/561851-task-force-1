<?php


namespace TaskForce\Helpers\Handlers;


class TaskImport extends AbstractCSVImport
{
    private static $tablename = 'task';

    public function correctedResults(array $row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'name' => $row[4],
                'cost' => $row[6],
                'description' => $row[2],
                'address' => $row[5],
                'lat' => $row[7],
                'lng' => $row[8],
                'completion_date' => $row[3],
                'category_id' => $row[1],
                'created_at' => $row[0],
                'author_id' => rand(1, 20)
            ]
        ];
    }
}
