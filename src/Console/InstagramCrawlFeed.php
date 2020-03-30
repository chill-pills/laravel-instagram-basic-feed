<?php

namespace ChillPills\InstagramBasicFeed\Console;

use Illuminate\Console\Command;
use ChillPills\InstagramBasicFeed\InstagramFeedCrawler;

class InstagramCrawlFeed extends Command {

    protected $signature = 'instagram-feed:crawl';

    protected $description = 'Connect to Facebook\'s Graphql to retrieve all the posts from the access token';

    public function handle() {
        $this->info('Fetched new posts : ');

        $instagramFeedCrawler = new InstagramFeedCrawler();

        foreach($instagramFeedCrawler->fetchNewFeed() as $post) {
            if (property_exists($post, 'caption')) {
                $this->info($post->caption);
            }
        }
    }
}