<?php

namespace App\Http\Controllers;

use App\Services\FeedRSS\FeedRSSService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(FeedRSSService $feedRSSService)
    {
        $feedRSSService::start();
    }
}
