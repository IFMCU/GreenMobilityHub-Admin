<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class Merchants extends Controller
{
  // Merchants Controller
  public function merchants()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantmaster');
    $dataResults = $resultAPI->json();

    return view('content.admin.merchants', compact('token', 'id', 'name', 'dataResults', 'session'));
  }

  public function merchantsAdd()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    return view('content.admin.merchantsAdd', compact('token', 'id', 'name', 'session'));
  }

  public function merchantsEdit($guid)
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantmaster/'. $guid);
    $dataResults = $resultAPI->json();
    
    return view('content.admin.merchantsEdit', compact('token', 'id', 'name','dataResults', 'session'));
  }

  public function merchantsDelete()
  {
    return view('content.admin.merchants');
  }
  // Merchants Controller

  // Merchants Merchants Locations Controller
  public function merchantsLocations()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantlocation');
    $dataResults = $resultAPI->json();

    return view('content.admin.merchantLocations', compact('token', 'id', 'name', 'dataResults', 'session'));
  }

  public function merchantsLocationsEdit($guid)
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantlocation/'. $guid);
    $dataResults = $resultAPI->json();

    $resultAPIMerchantMaster = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantmaster');
    $dataResultsMerchantMaster = $resultAPIMerchantMaster->json();
    
    return view('content.admin.merchantLocationsEdit', compact('token', 'id', 'name', 'dataResultsMerchantMaster', 'dataResults', 'session'));
  }

  public function merchantsLocationsAdd()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPIMerchantMaster = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/merchantmaster');
    $dataResultsMerchantMaster = $resultAPIMerchantMaster->json();
    
    return view('content.admin.merchantLocationsAdd', compact('token', 'id', 'name', 'dataResultsMerchantMaster', 'session'));
  }

  public function merchantsLocationsDelete()
  {
    return view('content.admin.merchantLocations');
  }
  // Merchants Merchants Locations Controller

  // Merchants parking lots Controller
  public function parkingLots()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/parkinglot');
    $dataResults = $resultAPI->json();

    return view('content.admin.parkingLots', compact('token', 'id', 'name', 'dataResults', 'session'));
  }

  public function parkingLotsEdit($guid)
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/parkinglot/'. $guid);
    $dataResults = $resultAPI->json();
    
    return view('content.admin.parkingLotsEdit', compact('token', 'id', 'name','dataResults', 'session'));
  }

  public function parkingLotsAdd()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    return view('content.admin.parkingLotsAdd', compact('token', 'id', 'name', 'session'));
  }

  public function parkingLotsDelete()
  {
    return view('content.admin.parkingLots');
  }
  // Merchants parking lots Controller

  // Merchants users Controller
  public function users()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/user');
    $dataResults = $resultAPI->json();

    return view('content.admin.users', compact('token', 'id', 'name', 'dataResults', 'session'));
  }

  public function usersEdit($guid)
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/user/'. $guid);
    $dataResults = $resultAPI->json();
    
    return view('content.admin.usersEdit', compact('token', 'id', 'name','dataResults', 'session'));
  }

  public function usersAdd()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');

    return view('content.admin.usersAdd', compact('token', 'id', 'name', 'session'));
  }

  public function usersDelete()
  {
    return view('content.admin.users');
  }
  // Merchants users Controller


}
