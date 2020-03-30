<?php

namespace ChillPills\InstagramBasicFeed\Facades;

use Illuminate\Support\Facades\Facade;

class InstagramBasicFeed extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'instagram-basic-feed';
    }
}
