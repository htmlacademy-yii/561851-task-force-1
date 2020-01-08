<?php


namespace TaskForce\Helpers\Handlers;


abstract class AbstractCSVImport
{
    /**
     * Corrected Results
     */
    abstract public function correctedResults(array $row): array;
}
