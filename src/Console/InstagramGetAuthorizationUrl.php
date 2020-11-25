<?php

namespace ChillPills\InstagramBasicFeed\Console;

use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use Illuminate\Console\Command;

class InstagramGetAuthorizationUrl extends Command
{
    protected $signature = 'instagram-feed:get-authorization-url';

    protected $description = 'Generates the link to the Authorization Window page';

    public function handle()
    {
        $this->instagramBasicDisplay = new InstagramBasicDisplay([
            'appId' => config('instagram-basic-feed.instagram_app_id'),
            'appSecret' => config('instagram-basic-feed.instagram_secret_key'),
            'redirectUri' => config('instagram-basic-feed.instagram_valid_oauth_uri'),
        ]);

        $this->info($this->instagramBasicDisplay->getLoginUrl());
    }
}
