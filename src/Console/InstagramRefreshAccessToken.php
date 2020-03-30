<?php

namespace ChillPills\InstagramBasicFeed\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;

class InstagramRefreshAccessToken extends Command {
    
    protected $signature = 'instagram-feed:refresh-key';

    protected $description = 'Ask Facebook\'s graphQL to refresh the Instagram Basic API Access Token';

    public $currentAccessToken;
    public $instagramBasicDisplay;

    public function handle()  {
        $this->currentAccessToken = config('instagram-feed.access_token');

        $this->instagramBasicDisplay = new InstagramBasicDisplay($this->currentAccessToken);

        $this->info('[InstagramRefreshAccessToken] handle');
        $this->info('[CURRENT_ACCESS_TOKEN] : ' . config('instagram-feed.access_token'));
        $this->info('[CURRENT_ACCESS_TOKEN] : ' . Config::get('instagram-feed.access_token'));
        $newAccessToken = $this->instagramBasicDisplay->refreshToken($this->currentAccessToken);
        $this->setNewAccessTokenToEnvFile($newAccessToken);
    }

    public function setNewAccessTokenToEnvFile($newAccessToken)
    {
        $this->info('[!!] Old access Token : ' . env('INSTAGRAM_ACCESS_TOKEN'));
        // $this->info(print_r($newAccessToken->access_token, true));
        putenv('INSTAGRAM_ACCESS_TOKEN=' . $newAccessToken->access_token);
        $this->info('[!!] New access Token : ' . env('INSTAGRAM_ACCESS_TOKEN'));
    }
}