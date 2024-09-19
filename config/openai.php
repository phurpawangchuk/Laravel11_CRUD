<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | This value is the API key used to authenticate requests to OpenAI's API.
    | Ensure you set this key in your environment file (.env).
    |
    */

    'api_key' => env('OPENAI_API_KEY', 'aaa'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Model
    |--------------------------------------------------------------------------
    |
    | This value represents the default model to use when querying the OpenAI API.
    | You can specify the model you want to use, e.g., gpt-3.5-turbo, gpt-4, etc.
    |
    */

    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Base URI
    |--------------------------------------------------------------------------
    |
    | This value defines the base URI for OpenAI's API.
    |
    */

    'base_uri' => env('OPENAI_BASE_URI', 'https://api.openai.com/v1/'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Request Timeout
    |--------------------------------------------------------------------------
    |
    | Define the request timeout for API requests to OpenAI.
    |
    */

    'timeout' => env('OPENAI_TIMEOUT', 10.0),

];