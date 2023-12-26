<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            [
                'name' => 'Alat Olahraga',
            ],
            [
                'name' => 'Alat Musik',
            ]
        ];

        foreach ($category as $ctg) {
            Categories::create($ctg);
        }
    }
}
