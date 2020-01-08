<?php


namespace TaskForce\Helpers\Handlers;


abstract class CsvImport
{
    /**
     * Corrected Results
     */
    abstract public function correctedResults(array $row): array;
}
