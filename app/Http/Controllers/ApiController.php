<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\ApiServiceProvider;

class ApiController extends Controller
{
    protected $apiService;

    public function __construct(ApiServiceProvider $apiService)
    {
        $this->apiService = $apiService;
    }

    public function showData()
    {
       
        $url = 'http://localhost:3000/api/trails/';
        $data = $this->apiService->fetchDataFromExternalApi($url);
        return view('data.show', ['data' => $data]);

        // $url = 'https://jsonplaceholder.typicode.com/users';
        // $data = $this->apiService->fetchDataFromExternalApi($url);
        // return response()->json($data);
    }
}