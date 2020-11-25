# Laravel Instagram Basic Feed

Laravel package connecting to Instagram's new API Basic Display. Retrieving personal user's posts and keep them in cache, with specific commands or with Scheduler, and taking charge of refreshing the Instagram token every two months.

## Get started

To use the [Instagram Basic Display API](https://developers.facebook.com/docs/instagram-basic-display-api), you will need to register a Facebook app and configure Instagram Basic Display. Follow the [getting started guide](https://developers.facebook.com/docs/instagram-basic-display-api/getting-started).

## Requirements

- PHP 7 or higher
- cURL
- Facebook Developer Account
- Facebook App

## Installation

Install the package in your application by running

```bash
composer require chill-pills/laravel-instagram-basic-feed
```

Add and complete these lines in your .env file

```bash
INSTAGRAM_VALID_OAUTH_URI=
INSTAGRAM_APP_ID=
INSTAGRAM_SECRET_KEY=
INSTAGRAM_ACCESS_TOKEN=
```

For the `INSTAGRAM_VALID_OAUTH_URI` entry, you will use the same URI you used in the Valid OAuth Redirect URIs field when you created the Instagram App. We will retrieve the `INSTAGRAM_ACCESS_TOKEN` in the next steps. (Ensure all the other env entries are complete)

## Set Up

We will need to go over the following steps to ensure our package is configure to work correctly;
- Permit your App to access your Instagram account’s profile and media
- Retrieve the Authorization code that from the URL 
- Use the authorization code to obtain a short-lived API token
- Exchange the short-lived API token for a long-lived API token

### Permit your App to access your Instagram account’s profile and media

We need to generate a link which redirects the user to the Instagram “Authorization Window". You can generate the url by running the following command:

```bash
php artisan instagram-feed:get-authorization-url
``` 
Copy & Enter the url in your browser (Your authorization window link should look something like this)

```bash
https://api.instagram.com/oauth/authorize
  ?client_id={INSTAGRAM_APP_ID}
  &redirect_uri={INSTAGRAM_VALID_OAUTH_URI}
  &scope=user_profile,user_media
  &response_type=code
``` 

Next, you will be shown the Authorization Window

![Image of Yaktocat](https://miro.medium.com/max/572/1*cZkdBYn19OIyyPLyPTWAbA.png)

Click on Authorize

### Retrieve the Authorization code that from the URL

You will be redirected to the `INSTAGRAM_VALID_OAUTH_URI`. If you look in your browser’s URL bar, you should notice the URL has an authorization code that has been appended to the redirect URL. Something like this:

```bash
{INSTAGRAM_VALID_OAUTH_URI}?code=AQBvJwCZtYdj1zLH_5myoAA1GRRpDhs1vcHFMzB4gvRk6dLkq5dNd24EVZ5FD9WoqQhfSuo6arUB17MPu2gRqEzP6EpsAl-9_2eC9-L6mWYQdWDyarkwDSNEs8T3gvoH-WLMHzhwwd6DJqP5PxJGf2ve53m7aGMEua3MzV8FZQVz5AfwWPN3G87n25jMBGgGGVj6G4pxJ9HqzNKmdpYK8GHKnRn_G03scHtUraFlEX5faCvz6ZO7Xw#_
``` 
 
Copy the authorization code, The authorization code in the redirect URL is everything after `code=` up to (but not including) the `#_` at the end.


## Usage

There's two commands that lets you fetch your feed or renew the Access Token.

```bash
php artisan instagram-feed:crawl
php artisan instagram-feed:refresh-key
```

You can add the following scheduler's command to take care of executing those commands automatically

```php
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(InstagramCrawlFeed::class)->hourly();
        $schedule->command(InstagramRefreshAccessToken::class)->monthly();
    }
```

Don't forget to enable the CRON on your machine for Laravel Basic Scheduler in your app/Console/Kernel.php file

```bash
* * * * * cd /home/path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

To show the Instagram feed on your page, you can just add the following Blade command to include the partial to your page.

```html
@include('instagram-basic-feed::instagram-post')
```

You can pass to the @include a hashtag used to search through the posts

```html
@include('instagram-basic-feed::instagram-post', ['hastag' => '#duckhunt'])
```


If you want to modify the view displaying the instagram posts itself

```bash
php artisan vendor:publish --tag=instagram-basic-feed-view
```


The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
