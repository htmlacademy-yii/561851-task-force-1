<?php


namespace TaskForce\Helpers\Handlers;


class CityImport extends AbstractCSVImport
{
    private static $tablename = 'city';

    public function correctedResults(array $row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'name' => $row[0],
                'lat' => $row[1],
                'lng' => $row[2]
            ]
        ];
    }
}
