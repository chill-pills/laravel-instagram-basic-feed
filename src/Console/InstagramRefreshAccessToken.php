<?php

namespace ChillPills\InstagramBasicFeed\Console;

use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class InstagramRefreshAccessToken extends Command
{
    protected $signature = 'instagram-feed:refresh-key';

    protected $description = 'Ask Facebook\'s graphQL to refresh the Instagram Basic API Access Token';

    public $currentAccessToken;
    public $instagramBasicDisplay;

    public function handle()
    {
        $this->currentAccessToken = config('instagram-basic-feed.access_token');

        $this->instagramBasicDisplay = new InstagramBasicDisplay($this->currentAccessToken);

        $this->info('[InstagramRefreshAccessToken] handle');
        $this->info('[CURRENT_ACCESS_TOKEN] : '.config('instagram-basic-feed.access_token'));
        $this->info('[CURRENT_ACCESS_TOKEN] : '.Config::get('instagram-basic-feed.access_token'));
        $newAccessToken = $this->instagramBasicDisplay->refreshToken($this->currentAccessToken);
        $this->setNewAccessTokenToEnvFile($newAccessToken);
    }

    public function setNewAccessTokenToEnvFile($newAccessToken)
    {
        $this->info('[!!] Old access Token : '.env('INSTAGRAM_ACCESS_TOKEN'));
        $key = 'INSTAGRAM_ACCESS_TOKEN';

        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $newAccessToken->access_token, file_get_contents($path)
            ));
        }

        $this->info('[!!] New access Token set successfully');
    }
}
