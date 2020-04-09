<?php

use Illuminate\Database\Seeder;
use App\Resume;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newResume = new Resume();
        $newResume->resume = '我的履歷 1';
        $newResume->resume_content = '這是我的第一份履歷';
        $newResume->user_id = 1;
        $newResume->save();
        $newResume->tags()->attach([1]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '我的履歷 2';
        $newResume->resume_content = '這是我的第二份履歷';
        $newResume->user_id = 1;
        $newResume->save();
        $newResume->tags()->attach([2]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '我的履歷 3';
        $newResume->resume_content = '這是我的第三份履歷';
        $newResume->user_id = 1;
        $newResume->save();
        $newResume->tags()->attach([1, 2]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '我的履歷 4';
        $newResume->resume_content = '這是我的第四份履歷';
        $newResume->user_id = 1;
        $newResume->save();
    }
}
