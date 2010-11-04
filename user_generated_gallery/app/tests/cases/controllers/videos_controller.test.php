<?php
/* Videos Test cases generated on: 2010-11-03 21:11:25 : 1288819705*/
App::import('Controller', 'Videos');

class TestVideosController extends VideosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VideosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.video', 'app.user', 'app.group', 'app.collection', 'app.collections_user', 'app.collections_video');

	function startTest() {
		$this->Videos =& new TestVideosController();
		$this->Videos->constructClasses();
	}

	function endTest() {
		unset($this->Videos);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>