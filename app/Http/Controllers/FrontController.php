<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EnquirySend;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class FrontController extends Controller
{
    public function index(){
    	return view('front.index');
    }

    public function contact(){
    	return view('front.contact');
    }

    public function postContact(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('contact')],
        ]);

    	\Mail::to('info@nortiena.com')->send(new EnquirySend($request));

    	return redirect(route('contact'))->withMsg('Thank you for contacting us. We will get back to you as soon as possible.');
    }

    public function updates(Request $request){
        return view('front.updates');
    }
}
