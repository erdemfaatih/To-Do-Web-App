<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ApiService;
use App\Models\Task;
use App\Models\Developer;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(ApiService $apiService)
    {
    
        $firstApiData = $apiService->fetchFirstApiData();
        foreach ($firstApiData as $task) {
            Task::create([
                'title' => $task['title'],
                'time' => $task['time'],
                'level' => $task['level'],
            ]);
        }

    
        $secondApiData = $apiService->fetchSecondApiData();


        Task::create([
            'title' => $secondApiData['task']['title'],
            'time' => $secondApiData['task']['time'],
            'level' => $secondApiData['task']['level'],
        ]);

        foreach ($secondApiData['developers'] as $developer) {
            Developer::create([
                'name' => $developer['name'],
                'time' => $developer['time'],
                'level' => $developer['level'],
                'result' => $developer['result'],
            ]);
        }
    }
}

