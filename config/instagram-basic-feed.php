<?php

return [

    /*
     * Generate an access token for a specific user.
     * This token let you fetch only the user's feed
     */
    'access-token' => env('INSTAGRAM_ACCESS_TOKEN'),

    /*
     * String name used to store the feed in the cache
     */

    'cache-key' => env('INSTAGRAM_BASIC_API_CACHE_KEY', 'instagram-medias')
];
