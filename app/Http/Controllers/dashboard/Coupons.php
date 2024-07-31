<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class Coupons extends Controller
{
   
    public function coupons()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $guid = $session->get('guid');
        $name = $session->get('name');
        $point = $session->get('point');
    
        $resultAPI = Http::withHeaders([
          'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/coupon');
        $dataResults = $resultAPI->json();

        // dd($dataResults);
        return view('content.dashboard.coupons', compact('token', 'guid', 'name','point','dataResults', 'session'));
    }
}