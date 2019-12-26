<?php


namespace TaskForce\Helpers\Handlers;


class ProfileImport extends CsvImport
{
    private static $tablename = 'user';
    private static $filename = 'profile';

    public function correctedResults($row): array
    {
        return [
            'tablename' => self::$tablename,
            'filename' => self::$filename,
            'row' => [
                'address' => $row[0],
                'birthday' => $row[1],
                'description' => $row[2],
                'phone' => $row[3],
                'skype' => $row[4]
            ]
        ];
    }
}
