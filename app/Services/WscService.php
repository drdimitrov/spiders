<?php

namespace App\Services;

class WscService{

	protected $apiKey;

	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
	}

	public function fetchSpecies($lsid){

		$client = new \GuzzleHttp\Client();

		$res = $client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spidersp:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return $res->getBody();
	}

	public function fetchGenus($lsid){

		$client = new \GuzzleHttp\Client();

		$res = $client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spidergen:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return $res->getBody();
	}

	public function fetchFamily($lsid){

		$client = new \GuzzleHttp\Client();

		$res = $client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spiderfam:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return $res->getBody();
	}
	
	
}
