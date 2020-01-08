<?php

namespace TaskForce\Helpers;

use TaskForce\Exceptions\SourceFileException;
use SplFileObject;
use TaskForce\Helpers\Handlers\AbstractCSVImport;


class TransformCsvToSql
{
    private $filename;
    private $handler;
    private $sqlAction;
    private $columns;
    private $fp;
    public $queries;
    private $dir = 'data/';

    /**
     * TransformCsvToSql constructor.
     * @param string $filename
     * @param object $handler
     * @param string $sqlAction
     */
    public function __construct(string $filename, AbstractCSVImport $handler, string $sqlAction = 'INSERT')
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
     *
     * @param $sqlFileName
     */
    public function transform($sqlFileName):void
    {
        foreach ($this->getNextLine() as $line) {

            if (!empty($line[0])) {
                $row = $this->handler->correctedResults($line);

                if (!empty($row['row'])) {

                    $query = $this->sqlAction === 'INSERT' ? $this->getInsertString($row['row'], $row['tablename']) : $this->getUpdateString($row['row'], $row['tablename'], $row['maxCountIds']);

                    $this->queries[] = $query;
                }
            }
        }

        $this->createSqlFile($sqlFileName);
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
    private function createSqlFile (string $filename):void {

        $sqlFileName = $this->dir . $filename . ".sql";

        $f = new SplFileObject($sqlFileName, 'w+');

        foreach ($this->queries as $query) {
            $f->fwrite($query .  PHP_EOL);
        }
    }

    /**
     * @param $row
     * @param $tablename
     * @return string
     */
    private function getInsertString (array $row, string $tablename):string {
        $data = [];
        $columns = [];

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
    public function getUpdateString (array $row, string $tablename, int $maxCountIds):string {
        $data = [];

        foreach ($row as $key => $value) {

            if (gettype($value) === 'integer') {
                $data[] =  "`" . $key . "` = " . $value ;
            } else {
                $data[] = "`" . $key . "` = '" . $value . "'";
            }
        }

        $data = implode(',', $data);

        $query = "UPDATE " . $tablename . " SET " . $data . " WHERE `id`=" . rand(1, $maxCountIds) . ";";

        return $query;
    }
}
