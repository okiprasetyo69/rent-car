<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Items;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Beras',
                'brand' => 'Pandanwangi',
                'qty' => 100,
                'shelf_number' => 1,
                'price' => 300000
            ],
            [
                'name' => 'Coca Cola',
                'brand' => 'Coca Cola',
                'qty' => 50,
                'shelf_number' => 2,
                'price' => 10000
            ],
            [
                'name' => 'Sabun Mandi',
                'brand' => 'Lux',
                'qty' => 150,
                'shelf_number' => 3,
                'price' => 5000
            ],
            [
                'name' => 'Pasta Gigi',
                'brand' => 'Pepsodent',
                'qty' => 100,
                'shelf_number' => 4,
                'price' => 9000
            ],
            [
                'name' => 'Sahmpo',
                'brand' => 'Rejoice',
                'qty' => 75,
                'shelf_number' => 5,
                'price' => 20000
            ],
        ];
        foreach ($items as $key => $value) {
            Items::create($value);
        }
    }
}
