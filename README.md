# Laravel Instagram Basic Feed

Laravel package that connect to Instagram's new API Basic Display. Retrieve personal user's posts and keep them in cache, with specific commands or with Scheduler and take care to refresh the token's every two months.

## Installation

This package require PHP 7.2 or later and Laravel 5.8 or higher.

```bash
composer required chill-pills/laravel-instagram-basic-feed
```

## Usage

There's two commands that let's you fetch your feed or renew the Access Token.

```bash
php artisan instagram-feed:crawl
php artisan instagram-feed:refresh-key
```

You can add the following scheduler's command to take care of executing thoses commands automatically

```php
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(InstagramCrawlFeed::class)->hourly();
        $schedule->command(InstagramRefreshAccessToken::class)->monthly();
    }
```

Don't forget to enable the CRON on your machine for Laravel Basic Scheduler

```bash
* * * * * cd /home/path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

To show the Instagram feed on your page, you can just add the following Blade command to include the partial to your page.

```html
@include('instagram-basic-feed::instagram-post')
```

You can pass to the include a hashtag so that we can search through the posts

```html
@include('instagram-basic-feed::instagram-post', ['hastag' => '#duckhunt'])
```
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.