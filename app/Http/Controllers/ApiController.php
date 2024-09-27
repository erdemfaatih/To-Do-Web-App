<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Models\Task;
use App\Models\Developer;

class ApiController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function fetchData()
    {
        $firstApiData = $this->apiService->fetchFirstApiData();

        foreach ($firstApiData as $task) {
            Task::create([
                'title' => $task['title'],
                'time' => $task['time'],
                'level' => $task['level'],
            ]);
        }

        return response()->json(['message' => 'First API data saved to the database successfully.']);
    }


    public function fetchSecondApi()
    {
        $data = $this->apiService->fetchSecondApiData();

        Task::create([
            'title' => $data['task']['title'],
            'time' => $data['task']['time'],
            'level' => $data['task']['level'],
        ]);

        foreach ($data['developers'] as $developer) {
            Developer::create([
                'name' => $developer['name'],
                'time' => $developer['time'],
                'level' => $developer['level'],
                'result' => $developer['result'],
            ]);
        }

        return response()->json(['message' => 'Second API data saved to the database successfully.']);
    }
}
