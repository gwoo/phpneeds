<?php

namespace app\controllers;

use app\models\Ideas;
use app\models\Tweets;

class IdeasController extends \lithium\action\Controller {

	protected $_admins = array('gwoo' => true);

	public function index() {
		$latest = Ideas::all(array('order' => array('date' => 'desc')));
		$popular = Ideas::all(array('order' => array('score' => 'desc')));
		$tweets = Tweets::search(array('q' => '#phpneeds'));
		return compact('latest', 'popular', 'tweets');
	}

	public function add() {
		if (!$this->request->user) {
			return $this->redirect('Login::index');
		}
		$idea = Ideas::create();
		$idea->user = $this->request->user;
		$idea->date = time();

		if (($this->request->data) && $idea->save($this->request->data)) {
			return $this->redirect(array('Ideas::index'));
		}
		return compact('idea');
	}

	public function vote() {
		if (!$this->request->user) {
			return $this->redirect('Login::index');
		}
		$idea = Ideas::find($this->request->id);

		if ($idea->hasVoted($this->request->user)) {
			return $this->redirect('Ideas::index');
		}
		if ($idea && $idea->vote($this->request->user)) {
			//success maaybe flash a message
		}
		return $this->redirect('Ideas::index');
	}

	public function delete() {
		if (isset($this->_admins[$this->request->user])) {
			Ideas::find($this->request->id)->delete();
		}
		return $this->redirect('Ideas::index');
	}
}

?>