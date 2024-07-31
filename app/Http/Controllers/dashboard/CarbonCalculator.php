<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class CarbonCalculator extends Controller
{
    // Carbon Calculator
    public function index()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
    
        $resultAPI = Http::withHeaders([
          'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/carbon');
        $dataResults = $resultAPI->json();
    
        return view('content.dashboard.carbon-calculator', compact('token', 'id', 'name', 'dataResults', 'session'));
    }
    // Carbon Calculator
}