<?php

use Illuminate\Database\Seeder;
use App\ResumeTag;

class ResumeTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 1;
        $newResumeTag->tag_id = 1;
        $newResumeTag->save();
        
        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 2;
        $newResumeTag->tag_id = 2;
        $newResumeTag->save();
        
        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 3;
        $newResumeTag->tag_id = 3;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 4;
        $newResumeTag->tag_id = 1;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 4;
        $newResumeTag->tag_id = 2;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 5;
        $newResumeTag->tag_id = 1;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 5;
        $newResumeTag->tag_id = 3;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 6;
        $newResumeTag->tag_id = 2;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 6;
        $newResumeTag->tag_id = 3;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 7;
        $newResumeTag->tag_id = 1;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 7;
        $newResumeTag->tag_id = 2;
        $newResumeTag->save();

        $newResumeTag = new ResumeTag();
        $newResumeTag->resume_id = 7;
        $newResumeTag->tag_id = 3;
        $newResumeTag->save();
    }
}
