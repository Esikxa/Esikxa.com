<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['title' => 'English','popular' => 1],
            ['title' => 'Nepali','popular' => 1],
            ['title' => 'Math','popular' => 1],
            ['title' => 'Account','popular' => 1],
            ['title' => 'Economics','popular' => 1],
            ['title' => 'Social Studies']
        ];

        $dbRecords = Subject::pluck('title')->toArray();

        foreach ($grades as $data) {
            if (!in_array($data['title'], $dbRecords)) {
                Subject::create($data);
            }
        }
    }
}