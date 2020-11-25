<?php

namespace ChillPills\InstagramBasicFeed\Console;

use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use Illuminate\Console\Command;

class InstagramSetNewAccessToken extends Command
{
    protected $signature = 'instagram-feed:setup-new-access-token {code : Authorization Code}';

    protected $description = 'Steps to generate initial Instagram Basic API Access Token';

    public $instagramBasicDisplay;
    public $shortLivedToken;
    public $longLivedToken;

    public function handle()
    {
        $code = $this->argument('code');
        $this->instagramBasicDisplay = new InstagramBasicDisplay([
            'appId' => config('instagram-basic-feed.instagram_app_id'),
            'appSecret' => config('instagram-basic-feed.instagram_secret_key'),
            'redirectUri' => config('instagram-basic-feed.instagram_valid_oauth_uri'),
        ]);

        // Get Short Lived Token
        $results = $this->instagramBasicDisplay->getOAuthToken($code);
        $this->shortLivedToken = $results->access_token;
        $this->info("short lived: $this->shortLivedToken");

        // Exchange Long Lived Token
        $results = $this->instagramBasicDisplay->getLongLivedToken($this->shortLivedToken);
        $this->longLivedToken = $results->access_token;
        $this->info("long lived: $this->longLivedToken");

        $this->writeTokenToEnvFile();
    }

    public function writeTokenToEnvFile()
    {
        $key = 'INSTAGRAM_ACCESS_TOKEN';

        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $this->longLivedToken, file_get_contents($path)
            ));
        }
    }
}
