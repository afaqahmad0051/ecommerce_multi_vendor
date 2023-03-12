<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values =  [
            ['name' => 'Dashboard'],
            ['name' => 'Product Group'],
            ['name' => 'Inventory'],
            ['name' => 'Discount Setup'],
            ['name' => 'Order Management'],
            ['name' => 'Order Return'],
            ['name' => 'Shippment'],
            ['name' => 'Vendor Management'],
            ['name' => 'User Management'],
            ['name' => 'Roles & Permissions'],
            ['name' => 'Blog Management'],
            ['name' => 'Review Management'],
            ['name' => 'Setting'],
            ['name' => 'Reports'],
        ];
        foreach ($values as $key => $value) {
            DB::table('permission_groups')->insert([
                'id' => $key+1,
                'name' => $value['name'],
                'status' => '1',
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
