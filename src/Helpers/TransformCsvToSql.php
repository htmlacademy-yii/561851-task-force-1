<?php


namespace TaskForce\Helpers;

use TaskForce\Exceptions\SourceFileException;
use SplFileObject;


class TransformCsvToSql
{
    private $filename;
    private $columns;
    private $fp;
    private $tablename;
    public $queries;
    private  $result = [];
    private $error = null;

    /**
     * TransformCsvToSql constructor.
     * @param $filename
     * @param $columns
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->tablename = basename($this->filename, ".csv");
    }

    public function transform():void
    {
        $this->getColumns();

        if (!$this->columns) {
            throw new SourceFileException("Не удалось получить колонки");
        }

        foreach ($this->getNextLine() as $line) {
            if (!empty($line[0])) {
                $this->result[] = $line;
            }
        }

        if (empty($this->result)) {
            throw new SourceFileException("В файле нет данных, кроме названия колонок");
        }

        foreach ($this->result as $row) {
            $data = "";

            if (!empty($row)) {
                foreach ($row as $value) {
                    if (gettype($value) === 'integer') {
                        $data .= $value . "',";
                    } elseif (empty($value)) {
                        $data .= rand(1,8) . ",";
                    } else {
                        $data .= "'" . $value . "',";
                    }
                }

                $data = substr($data,0,-1);

                $query = "INSERT INTO " . $this->tablename . " (" . $this->columns . ") VALUES (" . $data . ")";

                $this->queries[] = $query;
            }
        }

        $this->createSqlFile($this->queries);
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        if (!file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }

        $this->fp = new SplFileObject($this->filename);

        if (!$this->fp) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $this->fp->rewind();

        $this->columns = implode(',', $this->fp->fgetcsv());

        return $this->columns;
    }

    private function getNextLine():?iterable {
        $result = null;
        while (!$this->fp->eof()) {
            yield $this->fp->fgetcsv();
        }
        return $result;
    }

    private function createSqlFile ($queries) {

        $dir = 'data/';
        $sqlFileName = $dir . $this->tablename . ".sql";

        $f = new SplFileObject($sqlFileName, 'w+');

        foreach ($queries as $query) {
            $f->fwrite($query .  PHP_EOL);
        }

        $f = null;
    }
}
