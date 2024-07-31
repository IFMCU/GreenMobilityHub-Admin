<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class Offer extends Controller
{
   
    public function offer()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $guid = $session->get('guid');
        $name = $session->get('name');
        $point = $session->get('point');
    
        $resultAPI = Http::withHeaders([
          'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/offer');
        $dataResults = $resultAPI->json();
        return view('content.dashboard.offer', compact('token', 'guid', 'name','point','dataResults', 'session'));
    }
}