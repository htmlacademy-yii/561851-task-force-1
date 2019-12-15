<?php


namespace TaskForce\Helpers;

use TaskForce\Exceptions\SourceFileException;


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

    public function transform($columns):void
    {
        if (!$this->columns) {
            throw new SourceFileException("Не удалось получить колонки");
        }

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }

        if (empty($this->result)) {
            throw new SourceFileException("В файле нет данных, кроме названия колонок");
        }

        foreach ($this->result as $row) {
            $data = '';

            if (!empty($row)) {
                foreach ($row as $value) {
                    if (gettype($value) === 'integer') {
                        $data .= $value . "',";
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

        $this->fp = fopen($this->filename, 'r');

        if (!$this->fp) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        rewind($this->fp);
        $this->columns = implode(',', fgetcsv($this->fp));

        return $this->columns;
    }

    private function getNextLine():?iterable {
        $result = null;
        while (!feof($this->fp)) {
            yield fgetcsv($this->fp);
        }
        return $result;
    }

    private function createSqlFile ($queries) {

        $dir = 'data/';
        $sqlFileName = $dir . $this->tablename . ".sql";

        if (!file_exists($sqlFileName)) {
            $f = fopen($sqlFileName, 'w+');

            foreach ($queries as $query) {
                fwrite($f, $query .  PHP_EOL);
            }

            fclose($f);
        }
    }
}
