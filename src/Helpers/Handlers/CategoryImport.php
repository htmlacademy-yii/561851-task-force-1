<?php


namespace TaskForce\Helpers\Handlers;


class CategoryImport extends CsvImport
{
    private static $tablename = 'category';

    public function correctedResults($row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'name' => $row[0],
                'icon' => $row[1]
            ]
        ];
    }
}
