<?php

namespace App\Services\Newsletter\Exceptions;

use Exception;

class UserAlreadySubscribedException extends Exception{

	protected $message = 'User is already subscribed.';

}