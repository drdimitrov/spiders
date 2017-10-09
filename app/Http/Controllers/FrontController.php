<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EnquirySend;

class FrontController extends Controller
{
    public function index(){
    	return view('front.index');
    }

    public function contact(){
    	return view('front.contact');
    }

    public function postContact(Request $request){

    	\Mail::to('info@nortiena.com')->send(new EnquirySend($request));

    	return redirect(route('contact'))->withMsg('Thank you for contacting us. We will get back to you as soon as possible.');
    }

    public function guide(){
        return view('front.guide');
    }
}
