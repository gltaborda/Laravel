<?php

namespace App\Http\Controllers;

use App\Models\Bike;

class WelcomeController extends Controller {
    
    public function index(){
        
        return view('welcome', ['ultimas' => Bike::getLast(4)]);
    }
    
}