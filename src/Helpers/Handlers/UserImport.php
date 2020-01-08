<?php


namespace TaskForce\Helpers\Handlers;


class UserImport extends AbstractCSVImport
{
    private static $tablename = 'user';

    public function correctedResults(array $row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'email' => $row[0],
                'name' => $row[1],
                'pass' => password_hash($row[2], PASSWORD_DEFAULT),
                'created_at' => $row[3],
                'city_id' => rand(1, 1108)
            ]
        ];
    }
}
