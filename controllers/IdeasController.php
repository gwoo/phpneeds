<?php

namespace app\controllers;

use app\models\Ideas;

class IdeasController extends \lithium\action\Controller {

	public function index() {
		$latest = Ideas::all();
		$popular = Ideas::all();
		return compact('latest', 'popular');
	}
	
	public function add() {
		$idea = Ideas::create();
		
		if (($this->request->data) && $idea->save($this->request->data)) {
			$this->redirect(array('Ideas::index'));
		}
		return compact('idea');
	}

	public function vote() {
		$idea = Ideas::find($this->request->id);

		if ($idea && $idea->save(array('score' => $idea->score + 1))) {
			//success maaybe flash a message
		}
		$this->redirect('Ideas::index');
	}
}

?>