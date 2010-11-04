<?php
/* Collections Test cases generated on: 2010-11-03 21:11:54 : 1288819674*/
App::import('Controller', 'Collections');

class TestCollectionsController extends CollectionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CollectionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.collection', 'app.user', 'app.collections_user', 'app.video', 'app.collections_video');

	function startTest() {
		$this->Collections =& new TestCollectionsController();
		$this->Collections->constructClasses();
	}

	function endTest() {
		unset($this->Collections);
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