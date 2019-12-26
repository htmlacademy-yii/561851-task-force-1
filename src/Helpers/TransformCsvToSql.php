<?php


namespace TaskForce\Helpers;

use TaskForce\Exceptions\SourceFileException;
use SplFileObject;


class TransformCsvToSql
{
    private $filename;
    private $columns;
    private $fp;
    private $type;
    public $queries;
    private $handler;
    private  $result = [];

    /**
     * TransformCsvToSql constructor.
     * @param $filename
     * @param $columns
     */
    public function __construct(string $filename, string $handler, string $type = 'INSERT')
    {
        $this->filename = $filename;
        $this->handler = $handler;
        $this->type = $type;
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

            $classImport = new $this->handler;

            $row = $classImport->correctedResults($row);

            $data = "";
            $columns = "";

            if (!empty($row['row'])) {

                if ($this->type === 'INSERT') {

                    foreach ($row['row'] as $key => $value) {
                        if (gettype($value) === 'integer') {
                            $data .= $value . ",";
                        } else {
                            $data .= "'" . $value . "',";
                        }

                        $columns .= "`" . $key . "`,";
                    }

                    $data = substr($data,0,-1);
                    $columns = substr($columns,0,-1);

                    $query = "INSERT INTO " . $row['tablename'] . " (" . $columns . ") VALUES (" . $data . ")";
                }

                if ($this->type === 'UPDATE') {

                    foreach ($row['row'] as $key => $value) {

                        if (gettype($value) === 'integer') {
                            $data .= "`" . $key . "` = " . $value . ",";
                        } else {
                            $data .= "`" . $key . "` = '" . $value . "',";
                        }
                    }

                    $data = substr($data,0,-1);

                    $query = "UPDATE " . $row['tablename'] . " SET (" . $data . ")";
                }

                $this->queries[] = $query;
            }
        }

        $filename = $row['filename'] ?? $row['tablename'];

        $this->createSqlFile($this->queries, $filename);
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

    private function createSqlFile ($queries, $filename) {

        $dir = 'data/';
        $sqlFileName = $dir . $filename . ".sql";

        $f = new SplFileObject($sqlFileName, 'w+');

        foreach ($queries as $query) {
            $f->fwrite($query .  PHP_EOL);
        }

        $f = null;
    }
}
