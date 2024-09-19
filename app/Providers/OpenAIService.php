<?php

namespace App\Providers;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
      
      $this->client = new Client([
            'base_uri' => config('openai.base_uri'),
            'timeout'  => config('openai.timeout'),
        ]);

        // Fetch API key from config
        $this->apiKey = config('openai.api_key');

    }

    public function generateSqlQuery($prompt)
{
        $response = $this->client->post('chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert SQL query generator...',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
        ],
    ]);

    $data = json_decode($response->getBody()->getContents(), true);

    // Extract the SQL query from the response
    $sqlQuery = $data['choices'][0]['message']['content'];

    // Remove any non-SQL text
    $sqlQuery = trim(preg_replace('/^.*?```sql\s*(.*?)\s*```.*$/s', '$1', $sqlQuery));

    return $sqlQuery;
}

public function formatResponse($rawData)
{
    $decodedData = json_decode($rawData, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        return $decodedData; // Return valid JSON
    } else {
        return [
            'error' => 'Failed to decode the raw data into valid JSON.',
            'raw' => $rawData,
        ];
    }

}

}