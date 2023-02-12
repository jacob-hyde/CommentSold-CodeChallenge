<?php

namespace Database\Seeders;

use App\Models\Order;

class OrderSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->streamCsvData(storage_path('seeder-data/orders.csv'), function (array $orderData) {
            Order::updateOrCreate(['id' => $orderData['id']], $orderData);
        });
    }
}
