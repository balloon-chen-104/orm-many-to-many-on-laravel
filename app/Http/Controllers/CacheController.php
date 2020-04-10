<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Resume;

class CacheController extends Controller
{
    public function index()
    {
        // Cache 做法

        // $resume = Resume::find(3);

        // Cache::put('resume', $resume);

        // $resume = Cache::get('resume');

        // return $resume->tags;



        // redis 做法

        $resume = Resume::find(3);
        $resume->tags;
        $resume->user;

        $resume = json_encode($resume);
        Redis::set('resume', $resume);
        // Redis::expire('resume', 10);
        
        $resume = Redis::get('resume');
        $resume = json_decode($resume);

        return view('cache')->with('resume', $resume);
    }
}
