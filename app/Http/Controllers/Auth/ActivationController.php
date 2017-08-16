<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate(Request $r){
    	$user = User::where('email', $r->email)
    		->where('activation_token', $r->token)->firstOrFail();

		$user->update([
			'active' => true,
			'activation_token' => null
		]);

		\Auth::loginUsingId($user->id);

		return redirect()->route('home')->withSuccess('Activated. You are now signed in.');
    }

    public function showResendForm(){
    	return view('auth.activate.resend');
    }

    public function resend(Request $r){

    	$this->validate($r, [
    		'email' => 'required|email|exists:users,email'
		],[
			'email.exists' => 'Could not find that account.'
		]);

		$user = User::byEmail($r->email)->first();

		if($user->active){
			return redirect()->route('login')->withSuccess('Your account is already active.');
		}
		
		event(new UserRequestedActivationEmail($user));

		return redirect()->route('login')->withSuccess('Account activation email has been resent.');
    }
}
