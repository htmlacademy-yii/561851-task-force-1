<?php


namespace TaskForce\Helpers\Handlers;


class UserImport extends CsvImport
{
    private static $tablename = 'user';

    public function correctedResults($row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'email' => $row[0],
                'name' => $row[1],
                'pass' => $row[2],
                'created_at' => $row[3],
                'city_id' => rand(1, 1108)
            ]
        ];
    }
}
