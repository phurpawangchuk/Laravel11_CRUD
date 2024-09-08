<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ApiServiceProvider extends ServiceProvider
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(); // Create a Guzzle client instance
    }

    public function fetchDataFromExternalApi($url)
    {
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiYWRtaW4iLCJpYXQiOjE3MjU0MTg3MjMsImV4cCI6MTcyNTUwNTEyM30.TcKTqS_2m47WUW4lktreA6ARycXkmshM1MFu_UHLsEQ";
        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                return $data;
            }

        } catch (\Exception $e) {
            Log::error('Error fetching data: ' . $e->getMessage());
            return null;
        }
    }
}