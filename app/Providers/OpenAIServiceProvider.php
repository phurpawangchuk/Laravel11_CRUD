<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use App\Providers\OpenAIService;

class OpenAIServiceProvider extends ServiceProvider
{
    protected $client;
    protected $apiKey;

    /**
     * Register services.
     */
    public function register(): void
    {
      //  $this->mergeConfigFrom(__DIR__.'/../../config/openai.php', 'openai');

         $this->app->singleton(OpenAIService::class, function ($app) {
            return new OpenAIService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // $this->client = new Client();
        // $this->apiKey = config('openai.api_key');
        // dd($this->apiKey); // This should now output the correct API key
    }
}