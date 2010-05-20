<?php
	function genRandomString() {
		$length = 10;
		$chars = 'abcdefghijklmnopqrstyxuwvz0123456789';
		$string = '';    
		for ($p = 0; $p < $length; $p++) {
			$string .= $chars[mt_rand(0, strlen($chars))];
		}
		return $string;
	}
	echo genRandomString();
?>