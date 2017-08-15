<?php

namespace App\Http\Controllers;

use App\Services\Newsletter\NewsletterContract;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
	protected $newsletter;

	public function __construct(NewsletterContract $newsletter)
	{
		$this->newsletter = $newsletter;
	}

	public function create(){
		dd($this->newsletter);
	}
    
}
