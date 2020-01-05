<?php

namespace TaskForce\Helpers;

use TaskForce\Exceptions\SourceFileException;
use SplFileObject;


class TransformCsvToSql
{
    private $filename;
    private $handler;
    private $sqlAction;
    private $columns;
    private $fp;
    public $queries;

    /**
     * TransformCsvToSql constructor.
     * @param string $filename
     * @param object $handler
     * @param string $sqlAction
     */
    public function __construct(string $filename, object $handler, string $sqlAction = 'INSERT')
    {
        if (!file_exists($filename)) {
            throw new SourceFileException("Файл не существует");
        }

        $this->filename = $filename;
        $this->handler = $handler;
        $this->sqlAction = $sqlAction;
        $this->fp = new SplFileObject($this->filename);

        if (!$this->fp) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $this->fp->rewind();
        $this->columns = $this->fp->fgetcsv();
    }

    /**
     * TransformCsvToSql transform
     */
    public function transform():void
    {
        foreach ($this->getNextLine() as $line) {

            if (!empty($line[0])) {
                $row = $this->handler->correctedResults($line);

                if (!empty($row['row'])) {

                    $query = $this->sqlAction === 'INSERT' ? $this->getInsertString($row['row'], $row['tablename']) : $this->getUpdateString($row['row'], $row['tablename']);

                    $this->queries[] = $query;
                }
            }
        }

        $filename = $row['filename'] ?? $row['tablename'];

        $this->createSqlFile($this->queries, $filename);
    }

    /**
     * @return iterable|null
     */
    private function getNextLine():?iterable {

        while (!$this->fp->eof()) {
            yield $this->fp->fgetcsv();
        }

        return null;
    }

    /**
     * @param $queries
     * @param $filename
     */
    private function createSqlFile ($queries, $filename):void {

        $dir = 'data/';
        $sqlFileName = $dir . $filename . ".sql";

        $f = new SplFileObject($sqlFileName, 'w+');

        foreach ($queries as $query) {
            $f->fwrite($query .  PHP_EOL);
        }
    }

    /**
     * @param $row
     * @param $tablename
     * @return string
     */
    private function getInsertString ($row, $tablename):string {
        $data = array();
        $columns = array();

        foreach ($row as $key => $value) {
            if (gettype($value) === 'integer') {
                $data[] = $value;
            } else {
                $data[] = "'" . $value . "'";
            }

            $columns[] = "`" . $key . "`";
        }

        $data = implode(',', $data);
        $columns = implode(',', $columns);

        $query = "INSERT INTO " . $tablename . " (" . $columns . ") VALUES (" . $data . ");";

        return $query;
    }

    /**
     * @param $row
     * @param $tablename
     * @return string
     */
    public function getUpdateString ($row, $tablename):string {
        $data = array();

        foreach ($row as $key => $value) {

            if (gettype($value) === 'integer') {
                $data[] =  "`" . $key . "` = " . $value ;
            } else {
                $data[] = "`" . $key . "` = '" . $value . "'";
            }
        }

        $data = implode(',', $data);

        $query = "UPDATE " . $tablename . " SET " . $data . " WHERE `id`=" . rand(1,20) . ";";

        return $query;
    }
}
