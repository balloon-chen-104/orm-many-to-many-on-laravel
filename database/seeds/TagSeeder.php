<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newTag = new Tag();
        $newTag->tag = 'tag A';
        $newTag->save();
        
        $newTag = new Tag();
        $newTag->tag = 'tag B';
        $newTag->save();
        
        $newTag = new Tag();
        $newTag->tag = 'tag C';
        $newTag->save();
    }
}
