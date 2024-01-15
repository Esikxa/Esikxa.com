<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'title' => 'Site Name',
                'slug' => 'site_name',
                'type' => 'general',
                'value' => 'Esikxya.com'
            ],
            [
                'title' => 'Short Introduction',
                'slug' => 'short_introduction',
                'type' => 'general',
                'value' => 'This is short intro to Esikxya.com'
            ],
            [
                'title' => 'Logo',
                'slug' => 'logo',
                'type' => 'general',
                'value' => ''
            ],
            [
                'title' => 'Favicon',
                'slug' => 'favicon',
                'type' => 'general',
                'value' => ''
            ],
            [
                'title' => 'Email Address',
                'slug' => 'email_address',
                'type' => 'general',
                'value' => 'email@esikya.com'
            ],
            [
                'title' => 'Phone Number',
                'slug' => 'phone_number',
                'type' => 'general',
                'value' => '+97798XXXXXXXX'
            ],
            [
                'title' => 'Opening Time',
                'slug' => 'opening_time',
                'type' => 'general',
                'value' => '10:00AM - 5:00PM'
            ],
            [
                'title' => 'Address',
                'slug' => 'address',
                'type' => 'general',
                'value' => 'Kathmandu, Nepal'
            ],
            [
                'title' => 'Facebook',
                'slug' => 'facebook',
                'type' => 'general',
                'value' => '#'
            ],
            [
                'title' => 'Twitter',
                'slug' => 'twitter',
                'type' => 'general',
                'value' => '#'
            ],
            [
                'title' => 'Instagram',
                'slug' => 'instagram',
                'type' => 'general',
                'value' => '#'
            ],
            [
                'title' => 'LinkedIn',
                'slug' => 'linkedin',
                'type' => 'general',
                'value' => '#'
            ],
            [
                'title' => 'Youtube',
                'slug' => 'youtube',
                'type' => 'general',
                'value' => '#'
            ],
            [
                'title' => 'Google Map',
                'slug' => 'google_map',
                'type' => 'general',
                'value' => ' <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56516.27776849683!2d85.28493300558651!3d27.709030241818628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu%2044600!5e0!3m2!1sen!2snp!4v1697077950196!5m2!1sen!2snp"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>'
            ],

        ];

        $dbRecords = SiteSetting::pluck('slug')->toArray();

        foreach ($grades as $data) {
            if (!in_array($data['slug'], $dbRecords)) {
                SiteSetting::create($data);
            }
        }
    }
}
