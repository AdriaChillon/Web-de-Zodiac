<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lang;

class LangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'French',  'code' => 'fr'],
            ['name' => 'Spanish', 'code' => 'es'],
            ['name' => 'Deutsch', 'code' => 'de'],
        ];

        foreach ($languages as $language) {
            Lang::create($language);
        }
    }
}
