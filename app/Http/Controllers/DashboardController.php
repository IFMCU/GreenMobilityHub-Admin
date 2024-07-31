<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');

        $resultAPImerchant = Http::withHeaders([
            'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantmaster');
        $dataResultMerchant = $resultAPImerchant->json();

        $resultAPImerchantLocation = Http::withHeaders([
            'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantlocation');
        $dataResultMerchantLocation = $resultAPImerchantLocation->json();

        $resultAPIuser = Http::withHeaders([
            'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/user');
        $dataResultUser = $resultAPIuser->json();

        $resultAPIparkingLot = Http::withHeaders([
            'Authorization' => "Bearer " . $token
        ])->get(env("URL_API", "http://example.com") . '/api/v1/parkinglot');
        $dataResultParkingLot = $resultAPIparkingLot->json();


        $totalMerchants = count($dataResultMerchant);
        $totalUsers = count($dataResultUser);
        $totalMerchantLocations = count($dataResultMerchantLocation);
        $totalParkingLots = count($dataResultParkingLot);

        return view('content.dashboard.dashboards-analytics', compact('token', 'id', 'name', 'totalMerchants', 'totalUsers', 'totalMerchantLocations', 'totalParkingLots' ,'session'));
    }
    public function about(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
            
        
        return view('about', compact('token', 'id', 'name', 'session'));
    }
    public function maps(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => "application/json"
        ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantlocation');

        $data = json_decode($response, true);

        $responsePark = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => "application/json"
        ])->get(env("URL_API", "http://example.com") . '/api/v1/parkinglot');

        $dataPark = json_decode($responsePark, true);
    
        // dd( $data);
        return view('maps.index', compact('token', 'id', 'name', 'data', 'dataPark', 'session'));
    }
    
    
}
