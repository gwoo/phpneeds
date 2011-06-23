<?php

namespace app\models;

class Ideas extends \lithium\data\Model {

	public $validates = array();

	public function vote($idea, $user) {
		$idea->score = $idea->score + 1;
		$idea->voters = empty($idea->voters) ?: array();
		$idea->voters[$user] = true;
		return $idea->save();
	}

	public function hasVoted($idea, $user) {
		return isset($idea->voters[$user]);
	}
}

?>