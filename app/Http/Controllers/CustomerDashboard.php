<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboard extends Controller
{
    public function Home()
    {
    	return view('CustomerPanel.Dashboard');
    }
}
