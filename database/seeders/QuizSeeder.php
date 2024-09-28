<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $titles=['english quiz', 'physics quiz', 'maths quiz', 'french quiz', 'lorem ipsum quiz', 'DLD quiz', 'programming adipiscing', 'chemistry euismod', 'sagittis', 'Donec iaculis porttitor velit'];

    public function run()
    {
        foreach ($this->titles as $title) {
            Quiz::factory()->create([
                'title' => $title,
            ]);
        }
    }
}
