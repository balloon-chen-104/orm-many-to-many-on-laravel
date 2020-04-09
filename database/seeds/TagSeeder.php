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
        $newTag->tag = '工程師';
        $newTag->save();
        
        $newTag = new Tag();
        $newTag->tag = '設計師';
        $newTag->save();
    }
}
