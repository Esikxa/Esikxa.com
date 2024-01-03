<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['title' => 'Grade 1'],
            ['title' => 'Grade 2'],
            ['title' => 'Grade 3'],
            ['title' => 'Grade 4'],
            ['title' => 'Grade 5'],
            ['title' => 'Grade 6'],
            ['title' => 'Grade 7'],
            ['title' => 'Grade 8'],
            ['title' => 'Grade 10'],
            ['title' => 'Grade 11'],
            ['title' => 'Grade 12'],
        ];

        $dbRecords = Grade::pluck('title')->toArray();

        foreach ($grades as $data) {
            if (!in_array($data['title'], $dbRecords)) {
                Grade::create($data);
            }
        }
    }
}
