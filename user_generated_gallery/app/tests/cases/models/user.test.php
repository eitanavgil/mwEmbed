<?php
/* User Test cases generated on: 2010-11-03 21:11:17 : 1288819697*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.group', 'app.collection', 'app.collections_user', 'app.video', 'app.collections_video');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
?>