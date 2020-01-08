<?php


namespace TaskForce\Helpers\Handlers;


class ProfileImport extends AbstractCSVImport
{
    private static $tablename = 'user';

    public function correctedResults(array $row): array
    {
        return [
            'tablename' => self::$tablename,
            'row' => [
                'address' => $row[0] ?? null,
                'birthday' => $row[1] ?? null,
                'description' => $row[2] ?? null,
                'phone' => $row[3] ?? null,
                'skype' => $row[4] ?? null
            ],
            'maxCountIds' => 20
        ];
    }
}
