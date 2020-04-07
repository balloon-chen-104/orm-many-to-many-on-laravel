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
        $newResume->resume = '1st resume';
        $newResume->resume_content = 'Content 01';
        $newResume->save();
        $newResume->tags()->attach([1]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '2nd resume';
        $newResume->resume_content = 'Content 02';
        $newResume->save();
        $newResume->tags()->attach([2]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '3rd resume';
        $newResume->resume_content = 'Content 03';
        $newResume->save();
        $newResume->tags()->attach([3]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '4th resume';
        $newResume->resume_content = 'Content 04';
        $newResume->save();
        $newResume->tags()->attach([1, 2]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '5th resume';
        $newResume->resume_content = 'Content 05';
        $newResume->save();
        $newResume->tags()->attach([1, 3]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '6th resume';
        $newResume->resume_content = 'Content 06';
        $newResume->save();
        $newResume->tags()->attach([2, 3]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '7th resume';
        $newResume->resume_content = 'Content 07';
        $newResume->save();
        $newResume->tags()->attach([1, 2, 3]);
        $newResume->save();

        $newResume = new Resume();
        $newResume->resume = '8th resume';
        $newResume->resume_content = 'Content 08';
        $newResume->save();
    }
}
