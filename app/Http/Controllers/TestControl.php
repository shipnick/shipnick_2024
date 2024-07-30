<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\TestModel;

class TestControl extends Controller
{

    public function index()
    {
    	// return "work";
   	$params= Http::get('https://jsonplaceholder.typicode.com/todos')->json();
    return view('Test.test',["params"=>$params]);
    }


    public function upload()
    {
    $params= Http::get('https://jsonplaceholder.typicode.com/todos')->json();
   	foreach($params as $param){
   		$query = new TestModel;
   		$query->id = $param['id'];
   		$query->userid = $param['userId'];
   		$query->title = $param['title'];
   		$query->complete = $param['completed'];
   		$query->save();
   	}
	
	return redirect('/test');
    }

}
