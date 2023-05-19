<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Dipirona Sódica',
            'description' => 'Analgésico e antitérmico de 500mg utilizado em enfermidades que tenham dor e febre como sintomas',
            'product_code' => '152',
            'category' => 'Comprimido',
            'measurement_units' => 'Boxes',
            'unit_quantity' => '85',
        ]);
    }
}
