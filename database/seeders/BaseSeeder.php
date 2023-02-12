<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Get the data from the CSV file.
     *
     * @param string $filename The path of the CSV file.
     *
     * @return array The data from the CSV file.
     */
    protected function getCsvData(string $filePath): array
    {
        $csv = array_map('str_getcsv', file($filePath));
        $header = array_shift($csv);
        $data = [];
        foreach ($csv as $row) {
            $data[] = array_combine($header, $row);
        }
        return $data;
    }

    /**
     * Stream the data from the CSV file.
     *
     * @param string   $filePath The path of the CSV file.
     * @param callable $callback The callback to run on each row.
     *
     * @return void
     */
    protected function streamCsvData(string $filePath, callable $callback): void
    {
        $handle = fopen($filePath, 'r');
        $header = fgetcsv($handle);
        while ($row = fgetcsv($handle)) {
            $data = array_combine($header, $row);
            $data = array_filter($data, fn ($value) => $value !== 'NULL' && $value !== '');
            $callback($data);
        }
        fclose($handle);
    }
}
