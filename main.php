<!DOCTYPE html>
<html>
  <head>
      <title>Add Video</title>
      <style>
	    body {
			font-family:arial;
		}
        #progress {
          width: 200px;
          height: 20px;
          background-color: #eee;
        }
        #progressbar {
          height: 20px;
          background-color: #00f;
        }
      </style>
      <script src="http://firefogg.org/js/jquery.js"></script>
      <script>
        $(document).ready(function(){
			$('#submit').hide();
            $('#progress').hide();
			//get a special file token
			$.ajax({
				cache: false,
				url: 'getToken.php',
				error: function(xhr, ajaxOptions, thrownError) {
					writeLog (xhr.status + ": " + thrownError);
				},
				success: function(results) {
					$('#fToken').val(results);
				}});
        });

        if(typeof(Firefogg) == 'undefined') {
          alert('You dont have Firefogg, please go to http://firefogg.org to install it');
          document.location.href = 'http://firefogg.org';
        }
        var ogg = new Firefogg();
		var sourceFileInfo = null;
		
        function selectVideo() {
          if(ogg.selectVideo()) {
            $('#selectVideoButton').hide();
            $('#submit').show();
			var fToken = $('#fToken').val();
			//add the selected file name to the token (to make even more strict and easier to identify)
			$('#fToken').val(ogg.sourceFilename.replace( /\s/g, "" ) + '-' + fToken);
			sourceFileInfo = JSON.parse(ogg.sourceInfo);
			writeLog (ogg.sourceInfo);
          }
        }

        function submitForm() {
		  var bitrate = sourceFileInfo.bitrate;
		  var vidWidth = sourceFileInfo.video[0].width;
		  var vidHeight = sourceFileInfo.video[0].height;
		  var maxSize = Math.max(vidWidth, vidHeight);
		  var options = JSON.stringify({'maxSize':maxSize, 'videoBitrate':bitrate});
		  console.log ('params: ' + options);
		  
          var _data = $('#addVideo').serializeArray();
          var data = {}
          $(_data).each(function() {
            data[this.name] = this.value;
          })
          $('#addVideo').hide();
          $('#progress').show();
		  var baseUri = location.href.substr(0, location.href.lastIndexOf("/") + 1);
          encode_and_upload(baseUri + 'add.php?token=' + $('#fToken').val(), data, options); 
        }
        function encode_and_upload(postUrl, data, options) {
          ogg.upload(options, postUrl, JSON.stringify(data));
		  console.log ('upload to: ' + postUrl);
          var updateStatus = function() {
			writeLog (ogg.state + ', ' + ogg.uploadstatus());
			var status = ogg.status();
			var progress = ogg.progress();

			//do something with status and progress, i.e. set progressbar width:
			var progressbar = document.getElementById('progressbar');
			progressbar.style.width= parseInt(progress*200) +'px';
			$('#progressstatus').html(parseInt(progress*100) + '% - ' + status);

			//loop to get new status if still encoding
			if(ogg.state == 'encoding' || ogg.state == 'uploading') {
			  setTimeout(updateStatus, 500);
			}
			//encoding and upload sucessfull, could can also be 'encoding failed'
			else if (ogg.state == 'done') {
			  if(ogg.resultUrl) {
				writeLog ('done: ' + ogg.resultUrl);
				document.location.href = ogg.resultUrl;
			  } else {
				writeLog ('upload failed');
				writeLog (ogg.responseText);
			  }
			}
          }
		  
          updateStatus()
        }
		
		function writeLog (msg) {
			if (console.log) {
				console.log(msg);
			}
		}
      </script>
  </head>
  <body>
	<div style="width:550px;margin:0 auto;text-align:center;">
		<h1 style="padding:0;margin:0;margin-top:50px;">
			<a href="http://firefogg.org" target="_blank" title="Firefogg homepage"><img title="Powered by Firefogg" src="http://firefogg.org/png/firefogg.png" style="margin: 0pt auto; padding: 0pt; float:right;border:none;"/></a>
			Chunked upload & encode
		</h1>
		<h2 style="padding:0;margin:0;font-size:14px;color:#999;">(encoding and uploading at the same time)</h2>
		<div style="text-align:left;margin-left:15px;" id="content">
			<p>Please select a video file to upload</p>
			<p>
			  <div id="progress">
				<div id="progressbar"></div>
				<div id="progressstatus"></div>
			  </div>
			</p>
			<p>
			  <form id="addVideo">
				<p>Partner Id: <input type="text" name="pid" id="pid" value="" /></p>
				<p>Admin Secret: <input type="text" name="adminsecret" id="adminsecret" value="" /></p>
				<input type="hidden" name="fToken" id="fToken" />
				<input type="hidden" name="firstChunk" id="firstChunk" value="true" />
				<input type="button" value="Select Video..." id="selectVideoButton" onclick="selectVideo()" />
				<input type="button" value="Submit" id="submit" onclick="submitForm()" />
			  </form>
			</p>
		</div>
	</div>
  </body>
</html>
