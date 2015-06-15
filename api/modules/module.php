<?php

class PortalerModule {
	function __construct($app, $db) {
		$this->app = $app;
		$this->db = $db;
		$this->output = new stdClass();
	}

	function outputJSON() {
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->setBody(json_encode($this->output));
	}
}
