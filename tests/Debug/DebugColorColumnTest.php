<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Debug;

use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\ColorColumn;

class DebugColorColumnTest extends TestCase
{
    public function test_debug_rows(): void
    {
        $this->basicTable->setAdditionalSelects(['pets.species_id as species_id']);
        $debug = 'Additional Selects: '.json_encode($this->basicTable->getAdditionalSelects());
        $debug .= "\nSQL: ".$this->basicTable->builder()->toSql();
        $rows = $this->basicTable->rows;
        $row = $rows->first();

        $debug .= "\nID: ".$row->id;
        $debug .= "\nSpecies ID: ".$row->species_id;
        $debug .= "\nAttributes: ".json_encode($row->getAttributes());

        $column = ColorColumn::make('Species Color')->color(
            function ($row) {
                if ($row->species_id == 1) {
                    return '#ff0000';
                } elseif ($row->species_id == 2) {
                    return '#008000';
                } else {
                    return '#ffa500';
                }
            }
        );

        $debug .= "\nResult: ".app()->call($column->getColorCallback(), ['row' => $row]);
        file_put_contents('debug_output.txt', $debug);
    }
}
