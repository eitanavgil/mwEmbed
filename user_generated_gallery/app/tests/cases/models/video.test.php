<?php
/* Video Test cases generated on: 2010-11-03 21:11:24 : 1288819704*/
App::import('Model', 'Video');

class VideoTestCase extends CakeTestCase {
	var $fixtures = array('app.video', 'app.user', 'app.group', 'app.collection', 'app.collections_user', 'app.collections_video');

	function startTest() {
		$this->Video =& ClassRegistry::init('Video');
	}

	function endTest() {
		unset($this->Video);
		ClassRegistry::flush();
	}

}
?>