<?php

namespace ChillPills\InstagramBasicFeed\Console;

use ChillPills\InstagramBasicFeed\InstagramFeedCrawler;
use Illuminate\Console\Command;

class InstagramCrawlFeed extends Command
{
    protected $signature = 'instagram-feed:crawl';

    protected $description = 'Connect to Facebook\'s Graphql to retrieve all the posts from the access token';

    public function handle()
    {
        $this->info('Fetched new posts : ');

        $instagramFeedCrawler = new InstagramFeedCrawler();

        foreach ($instagramFeedCrawler->fetchNewFeed() as $post) {
            if (property_exists($post, 'caption')) {
                $this->info($post->caption);
            }
        }
    }
}
