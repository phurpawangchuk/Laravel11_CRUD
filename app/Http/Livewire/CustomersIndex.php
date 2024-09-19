<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

use App\Providers\OpenAIService;
use Illuminate\Support\Facades\DB;

class CustomersIndex extends Component
{
    public $posts;
    public $prompt;
    
    public function render()
    {
        return view('livewire.customers-index');
    }
    
    public function submit()
    {
        // $openAIService = app(OpenAIService::class);
        // // $this->prompt = "Give all posts with the title AA";
        // $sqlQuery = $openAIService->generateSqlQuery($this->prompt);
        // $results = DB::select($sqlQuery);
        // $this->posts = json_decode(json_encode($results), true);

    $openAIService = app(OpenAIService::class);

    try {
        $sqlQuery = $openAIService->generateSqlQuery($this->prompt);
        $results = DB::select($sqlQuery);

        // Check if the query returned any results
        if (empty($results)) {
            session()->flash('message', 'No posts found matching your query.');
            $this->posts = []; 
        } else {
            $this->posts = json_decode(json_encode($results), true);
        }
    } catch (\Exception $e) {
        session()->flash('error', 'An error occurred while processing your query: ');
        $this->posts = []; 
    }
    
    }
}