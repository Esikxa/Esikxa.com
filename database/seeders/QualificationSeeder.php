<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['uuid' => Str::uuid(),'title' => 'PHD'],
            ['uuid' => Str::uuid(),'title' => 'Master'],
            ['uuid' => Str::uuid(),'title' => 'Bachelor'],
            ['uuid' => Str::uuid(),'title' => 'Intermediate'],
            ['uuid' => Str::uuid(),'title' => 'Diploma'],
        ];

        $dbRecords = Qualification::pluck('title')->toArray();

        foreach ($grades as $data) {
            if (!in_array($data['title'], $dbRecords)) {
                Qualification::create($data);
            }
        }
    }
}