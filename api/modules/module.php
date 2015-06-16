<?php

class PortalerModule {
	function __construct($app, $db) {
		$this->app = $app;
		$this->db = $db;
		$this->output = array(
			'timestamp' => time()
		);
	}

	function outputJSON() {
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->setBody(json_encode($this->output));
	}

	function error($status = 500, $msg = '', $data = NULL) {
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->setStatus($status);
		$output = array();
		$output['message'] = $msg;
		if ($data !== NULL) { $output['data'] = $data; }
		$this->app->response->setBody(json_encode($output));
	}
}
