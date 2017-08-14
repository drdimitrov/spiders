<?php

namespace App\Services;

use GuzzleHttp\Client;

class WscService{

	protected $apiKey;
	protected $client;

	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
		$this->client = new Client();
	}

	public function fetchSpecies($lsid){

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spidersp:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return json_decode($res->getBody());
	}

	public function fetchGenus($lsid){

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spidergen:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return json_decode($res->getBody());
	}

	public function fetchFamily($lsid){

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spiderfam:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return json_decode($res->getBody());
	}
	
	public function fetchUpdatedTaxa($date){

		$taxa = [];
		
		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/updates?date=' . $date . '&apiKey=' . $this->apiKey
		);

		
		$temp = json_decode($res->getBody());

		foreach($temp->updates as $update){
			$taxa[] = $update;
		}

		return $taxa;

		// if(isset($temp->_links->next)){
			
		// }

	}
	
}
