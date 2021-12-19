<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Service\HomeClientService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Session\Session;

class HomeController extends Controller
{
    //
    private $homeClientService;
    public function __construct(HomeClientService $homeClientService)
    {
        $this->homeClientService = $homeClientService;
    }

    public function index()
    {
        return $this->homeClientService->viewIndexHomeCustomer();
    }

    public function details($id)
    {
        return $this->homeClientService->ShowDetailsProducts($id);
    }
}
