<?php

namespace app\controllers;

use \li3_oauth\models\Consumer;
use \lithium\storage\Session;

class LoginController extends \lithium\action\Controller {

	protected function _init() {
		parent::_init();
		Consumer::config(array(
			'host' => 'twitter.com',
			'oauth_consumer_key' => 'QYDVC9dJMpxdYna1b5Pw',
			'oauth_consumer_secret' => 'ZSNvLyBgJv5yETHrsmsqVOq7QUHNY5HtWTWRotfHgE',
			//'oauth_callback' => 'http://oio.local/apps/php_needs/'
		));
	}

	public function index() {
		$access = Session::read('oauth.access');
		$request = Session::read('oauth.request');
		
		if (empty($access) && !empty($this->request->query['oauth_token'])) {
			return $this->redirect('Login::access');
		}
		if (empty($request)) {
			return $this->redirect('Login::authorize');
		}
		return $this->redirect('/');
	}
	
	public function forget() {
		Session::delete('oauth.access');
		Session::delete('oauth.request');
		return $this->redirect('/');
	}

	public function authorize() {
		$token = Consumer::token('request');
		if (is_string($token)) {
			return $token;
		}
		Session::write('oauth.request', $token);
		return $this->redirect(Consumer::authorize($token, array(
			'oauth_callback' => 'http://oio.local/apps/php_needs/login'
		)));
	}

	public function access() {
		$token = Session::read('oauth.request');
		$access = Consumer::token('access', compact('token'));
		Session::write('oauth.access', $access);
		return $this->redirect('Login::index');
	}

	public function login() {
		$token = Session::read('oauth.request');
		if (empty($token)) {
			return $this->redirect('Login::authorize');
		}
		return $this->redirect(Consumer::authenticate($token));
	}
}

?>