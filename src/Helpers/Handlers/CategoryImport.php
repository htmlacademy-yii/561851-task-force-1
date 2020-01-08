<?php


namespace TaskForce\Helpers\Handlers;


class CategoryImport extends AbstractCSVImport
{
    private static $tablename = 'category';

    public function correctedResults(array $row): array
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
