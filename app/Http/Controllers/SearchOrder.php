<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchOrder extends Controller
{
    public function Home()	
	{
		return view('Admin.SearchOrder');
	}
}
