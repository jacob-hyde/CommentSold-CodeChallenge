<?php

namespace Database\Seeders;

use App\Models\Inventory;

class InventorySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->streamCsvData(storage_path('seeder-data/inventory.csv'), function (array $invetoryData) {
            Inventory::updateOrCreate(['id' => $invetoryData['id']], $invetoryData); //upsert may be faster
        });
    }
}
