<?php
/* Collection Test cases generated on: 2010-11-03 21:11:47 : 1288819667*/
App::import('Model', 'Collection');

class CollectionTestCase extends CakeTestCase {
	var $fixtures = array('app.collection', 'app.user', 'app.collections_user', 'app.video', 'app.collections_video');

	function startTest() {
		$this->Collection =& ClassRegistry::init('Collection');
	}

	function endTest() {
		unset($this->Collection);
		ClassRegistry::flush();
	}

}
?>