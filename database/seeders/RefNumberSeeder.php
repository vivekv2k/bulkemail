<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_ref_numbers')->insert([
            'ref_type' => 'TRAINING',
            'cmp_node' => '',
            'ref_year' => '2020',
            'ref_month' => '0',
            'ref_prfx' => 'CYB',
            'ref_nxt_seq' => '24',
        ]);
    }
}
