<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TrelloApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('TRELLO_BASE_URL');
        $this->apiKey = env('TRELLO_API_KEY');
        $this->apiToken = env('TRELLO_API_TOKEN');
    }

    public function getBoards()
    {
        $response = Http::get("{$this->baseUrl}/1/members/me/boards?key={$this->apiKey}&token={$this->apiToken}&fields=name,url");

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'Failed to retrieve boards data'];
        }
    }
}
