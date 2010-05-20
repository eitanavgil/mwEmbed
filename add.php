<?php
require_once("kaltura_client_v3/KalturaClient.php"); 
//Define Kaltura CONSTANTS
define("KALTURA_SERVER_HOST", "www.kaltura.com");
define("PARTNER_USER_ID", "firefogg-demo");
		
$videoId = $_GET['token'];
$pid = $_GET['pid'];
$adminsecret = $_GET['adminsecret'];
$add_php = 'http://' . $_SERVER['SERVER_NAME'] .  $_SERVER['PHP_SELF'];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  /*
  $title = $_POST['title'];
  $description = $_POST['description'];
  */
  $firstChunk = $_POST['firstChunk'];
  if ($firstChunk == 'true') {
  	$pid = $_POST['pid'];
	$adminsecret = $_POST['adminsecret'];
    $uploadUrl = $add_php . '?token=' . $videoId . '&pid=' . $pid . '&adminsecret=' . $adminsecret;
    echo json_encode(array('result' => 1, 'uploadUrl' => $uploadUrl));
  }
  else {
    //save video
    $filename = 'videos/' . $videoId . '.ogv';
    if($_FILES['chunk']['error'] == UPLOAD_ERR_OK) {
      $chunk = fopen($_FILES['chunk']['tmp_name'], 'r');
      if(!file_exists($filename)) {
        $f = fopen($filename, 'w');
      } else {
        $f = fopen($filename, 'a');
      }
      while ($data = fread($chunk, 1024))
        fwrite($f, $data);
      fclose($f);
      if($_POST['done'] == 1) {
        $resultUrl = str_replace('add.php', 'video.php', $add_php) . "?token=" . $videoId . '&pid=' . $pid . '&adminsecret=' . $adminsecret;

		$config           = new KalturaConfiguration($pid);
		$client           = new KalturaClient($config);
		$ks               = $client->session->start($adminsecret, PARTNER_USER_ID, KalturaSessionType::ADMIN, $pid, 86400, "edit:*");
		$client->setKs($ks);

		$importUrl = str_replace('add.php', 'videos/', $add_php) . $videoId . '.ogv';
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->mediaType = KalturaMediaType::VIDEO;
		$mediaEntry->name = $videoId;
		$mediaEntry->description = 'ogg client encoding';
		$mediaEntry->tags = 'ogg, client encoding, chunked upload';
		$mediaEntry->adminTags = 'ogg, client encoding, chunked upload';
		$addService = new KalturaMediaService ($client);
		$kaltureResult = $addService->addFromUrl($mediaEntry, $importUrl);
		
        echo json_encode(array('result' => 1, 'done' => 1, 'resultUrl' => $resultUrl));
      }
      else {
        echo json_encode(array('result' => 1));
      }
    } else {
      echo json_encode(array('result' => -1));
    }
  }
  exit();
}
?>