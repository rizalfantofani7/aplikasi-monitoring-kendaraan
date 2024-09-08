<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Kendaraan barang 1', 'type' => 'barang'],
            ['name' => 'Kendaraan penumpang 1', 'type' => 'penumpang'],
            ['name' => 'Kendaraan barang 2', 'type' => 'barang'],
            ['name' => 'Kendaraan penumpang 2', 'type' => 'penumpang'],
            ['name' => 'Kendaraan penumpang 3', 'type' => 'penumpang'],
            ['name' => 'Kendaraan barang 3', 'type' => 'barang'],
        ];
        
        foreach ($data as $item) {
            Vehicle::create($item);
        }
    }
}
