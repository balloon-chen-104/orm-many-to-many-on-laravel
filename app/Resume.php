<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = ['resume', 'resume_content'];
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
