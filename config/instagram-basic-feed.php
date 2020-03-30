<?php

return [

    /*
     * Give your Instagram App Id from the Facebook developer
     */
    'app_id' => env('INSTAGRAM_APP_ID'),

    /*
     * Give your Secret Key from the Facebook developer
     */
    'secret_key' => env('INSTAGRAM_SECRET_KEY'),

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
