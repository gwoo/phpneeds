<?php

namespace app\controllers;

use app\models\Ideas;

class IdeasController extends \lithium\action\Controller {

	public function index() {
		$ideas = Ideas::all();
		return compact('ideas');
	}

	public function view() {
		$idea = Ideas::first($this->request->id);
		return compact('idea');
	}

	public function add() {
		$idea = Ideas::create();

		if (($this->request->data) && $idea->save($this->request->data)) {
			$this->redirect(array('Ideas::view', 'args' => array($idea->id)));
		}
		return compact('idea');
	}

	public function edit() {
		$idea = Ideas::find($this->request->id);

		if (!$idea) {
			$this->redirect('Ideas::index');
		}
		if (($this->request->data) && $idea->save($this->request->data)) {
			$this->redirect(array('Ideas::view', 'args' => array($idea->id)));
		}
		return compact('idea');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Ideas::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Ideas::find($this->request->id)->delete();
		$this->redirect('Ideas::index');
	}
}

?>