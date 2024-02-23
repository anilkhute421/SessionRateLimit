<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{

    public function guest(){

     return view('welcome');

    }

    public function sessiondestroy(Request $request){
      
     $request->session()->forget('allowed_ip');

     echo 'session destroy';

    }
}
