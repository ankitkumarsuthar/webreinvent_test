<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToDo;

class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ToDo::create(['title' => 'First To-Do', 'description' => 'This is the first to-do item.']);
        ToDo::create(['title' => 'Second To-Do', 'description' => 'This is the second to-do item.']);
        ToDo::create(['title' => 'Third To-Do', 'description' => 'This is the third to-do item.']);
    }
}
