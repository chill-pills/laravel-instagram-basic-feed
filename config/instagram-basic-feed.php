<?php

return [

    /*
     * These are the information used to configure the Instagram Basic Display application.
     * Read the guide here (https://developers.facebook.com/docs/instagram-basic-display-api/getting-started).
     */
    'instagram_valid_oauth_uri' => env('INSTAGRAM_VALID_OAUTH_URI'),
    'instagram_app_id' => env('INSTAGRAM_APP_ID'),
    'instagram_secret_key' => env('INSTAGRAM_SECRET_KEY'),
    'instagram_app_scope' => env('INSTAGRAM_APP_SCOPE','user_profile,user_media'),

    /*
     * Generate an access token for a specific user.
     * This token let you fetch only the user's feed
     */
    'access-token' => env('INSTAGRAM_ACCESS_TOKEN'),

    /*
     * String name used to store the feed in the cache
     */

    'cache-key' => env('INSTAGRAM_BASIC_API_CACHE_KEY', 'instagram-medias'),
];
