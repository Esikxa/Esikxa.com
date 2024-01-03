<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::where('title', 'Nepal')->firstorfail();
        $provinces = array(
            'Koshi Province',
            'Madhesh Province',
            'Bagmati Province',
            'Gandaki Province',
            'Lumbini Province',
            'Karnali Province',
            'Sudurpashchim Province'
        );

        $dbProvinces = Province::pluck('title')->toArray();
        foreach ($provinces as $province) {
            if (!in_array($province, $dbProvinces)) {
                Province::create(['title' => $province, 'country_id' => $country->id]);
            }
        }
    }
}
