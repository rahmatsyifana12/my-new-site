<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TrelloApiService;

class BoardController extends Controller
{
    protected $trelloApiService;

    public function __construct()
    {
        $this->trelloApiService = new TrelloApiService();
    }

    public function getBoards()
    {
        $boards = $this->trelloApiService->getBoards();
        return $boards;
    }
}
