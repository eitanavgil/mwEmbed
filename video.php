<?php
$videoId = $_GET['token'];
?>
<!DOCTYPE html>
<html>
  <head>
      <title><?php echo $title ?></title>
  </head>
  <body>
	<div style="width:500px;margin:0 auto;text-align:center;">
		<h1>Uploaded video playback (<?php echo $videoId ?>)</h1>
		<video id="movie" width="320" height="240" autobuffer="autobuffer" controls="controls" autoplay="autoplay" >
			<source type='video/ogg; codecs="theora, vorbis"' src="videos/<?php echo $videoId ?>.ogv" >
		</video>
	</div>
  </body>
</html>
