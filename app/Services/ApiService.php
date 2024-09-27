<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{

    public function fetchFirstApiData()
    {
        try {
            $response = Http::get('https://gist.githubusercontent.com/firatozpinar/8b6ac47e177f07bd99046f873154cef3/raw');
            $jsonData = $response->body();

            $fixedJson = $this->fixMalformedJson($jsonData);

            $data = json_decode($fixedJson, true);
            
            return $data['data'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function fetchSecondApiData()
    {
        try {
            $response = Http::get('https://gist.githubusercontent.com/firatozpinar/18cc10a74a98b5381d169ade6d7627d9/raw');
            $jsonData = $response->body();

            $data = json_decode($jsonData, true);

            $taskData = $data['data'] ?? [];

            $developerData = $data['relations']['developers']['data'] ?? [];

            return [
                'task' => $taskData,
                'developers' => $developerData
            ];
        } catch (\Exception $e) {
            return [
                'task' => [],
                'developers' => []
            ];
        }
    }

    // Bozuk JSON'u düzeltme fonksiyonu (1. API için)
    private function fixMalformedJson($jsonData)
    {
        $jsonData = rtrim($jsonData, ','); // Son virgülü kaldır
        if (!str_ends_with($jsonData, ']}')) {
            $jsonData .= ']}'; // Eksik kapanış parantezlerini ekle
        }
        return $jsonData;
    }
}
