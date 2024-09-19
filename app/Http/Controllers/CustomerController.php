<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\OpenAIService;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
       $this->openAIService = $openAIService;
    }

    public function handleQuery(Request $request)
    {
        $prompt = "Give all posts with the title AA";

        // $prompt = "select only one post from the 'posts' where the title is 'AA'.";

        // Generate SQL query
        $sqlQuery = $this->openAIService->generateSqlQuery($prompt);

        // Debug the SQL query to ensure it's correct
        // dd($sqlQuery);

        // Execute SQL query
        $results = DB::select($sqlQuery);

        // Convert results to JSON
        $rawData = json_encode($results);

        // Format data using OpenAI
        // $formattedData = $this->openAIService->formatResponse($rawData);
        $formattedData = json_decode($rawData, true);

        // return response()->json($formattedData);

        // Return the data to the Blade view
        return view('query', ['posts' => $formattedData]);
    }

}