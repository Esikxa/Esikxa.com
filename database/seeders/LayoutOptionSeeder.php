<?php

namespace Database\Seeders;

use App\Models\LayoutOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'title' => 'Primary Menu',
                'slug' => 'primary-menu',
                'type' => '1',
            ],
            [
                'title' => 'Footer Widget 1',
                'slug' => 'widget-1',
                'type' => '1',
            ],
            [
                'title' => 'Footer Widget 2',
                'slug' => 'widget-2',
                'type' => '1',
            ],
            [
                'title' => 'Footer Widget 3',
                'slug' => 'widget-3',
                'type' => '1',
            ],
            [
                'title' => 'Block 1',
                'slug' => 'block-1',
                'type' => '2',
                'value' => ''
            ],
            [
                'title' => 'Block 2',
                'slug' => 'block-2',
                'type' => '2',
            ],
            [
                'title' => 'Block 3',
                'slug' => 'block-3',
                'type' => '2',
            ],

        ];
        $dbOptions = LayoutOption::pluck('slug')->toArray();
        foreach ($options as $option) {
            if (!in_array($option['slug'], $dbOptions)) {
                DB::table('layout_options')->insert($option);
            }
        }
    }
}
