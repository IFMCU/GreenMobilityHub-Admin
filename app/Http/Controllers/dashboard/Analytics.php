<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class Analytics extends Controller
{
  public function index()
  {
    

    return view('content.dashboard.dashboards-analytics');
  }
}
