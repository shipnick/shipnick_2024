<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;

class UserBarcode extends Controller
{
    public function index()
    {
    	$orderno = "1234567890";
		$d = new DNS1D();
		$d->setStorPath(__DIR__.'/cache/');
		$barcode = $d->getBarcodeHTML($orderno, 'EAN13');
		

		return view('Test.barcode',['barcode'=>$barcode,'orderno'=>$orderno]);
		// return view('Test.barcode',compact('barcode'));
    }
}
