<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a new role
        $role = \App\Models\Type::create([
            'code' => 'paid',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
