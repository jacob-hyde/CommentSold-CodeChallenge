<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends BaseSeeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->streamCsvData(storage_path('seeder-data/products.csv'), function (array $productData) {
            $productData['url'] = '/products/' . $productData['id']; // url could be generated on creation/update in model boot methods

            // There are duplicate products in the csv file, so we will use the id as the unique key
            Product::updateOrCreate(['id' => $productData['id']], $productData);
        });
    }
}
