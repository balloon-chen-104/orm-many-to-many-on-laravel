<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [];
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag', "resume_tags");
    }
}
