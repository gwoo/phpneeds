<?php

namespace app\models;

use lithium\net\http\Service;
use lithium\storage\Cache;

class Tweets extends \lithium\data\Model {

	public $validates = array();

	public static function search($data = array()) {
		// $tweet = Tweets::find(array('order' => array('id_str' => 'desc')));
		// $data += array('since_id' => $tweet->id_str);
		$data += array('result_type' => 'recent');

		$results = Cache::read('default', 'tweets');
		if (!$results) {
			$service = new Service(array('host' => 'api.twitter.com'));
		    $results = json_decode($service->get('search.json', $data));
			Cache::write('default', 'tweets', $results, '+15 minutes');
		}
		return $results;
	}
}

?>