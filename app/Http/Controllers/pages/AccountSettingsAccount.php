<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class AccountSettingsAccount extends Controller
{
  public function index()
  {
    $session = new Session();
    $token = $session->get('access_token');
    $id = $session->get('id');
    $name = $session->get('name');
    $guid = $session->get('guid');

    $resultAPI = Http::withHeaders([
      'Authorization' => "Bearer " . $token
    ])->get(env("URL_API", "http://example.com") . '/api/v1/user/'. $guid);
    $dataResults = $resultAPI->json();
    
    return view('content.pages.pages-account-settings-account', compact('token', 'id', 'name','dataResults', 'session'));
  }
}
