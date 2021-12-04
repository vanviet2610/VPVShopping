<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Service\HomeClientService;

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
}
