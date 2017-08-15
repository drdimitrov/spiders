<?php

namespace App\Services\Newsletter;

interface NewsletterContract{

	public function subscribe($listId, $email, $mergeVars = []);
	
}