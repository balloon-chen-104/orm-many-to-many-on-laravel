<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function resumes()
    {
        return $this->belongsToMany('App\Resume', 'resume_tags');
    }
}
