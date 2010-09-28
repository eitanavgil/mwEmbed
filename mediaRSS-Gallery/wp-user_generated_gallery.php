<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Kaltura User Generated Gallery
*/
?>

<!--include external scripts and define constants -->
<?php 
	require_once("/home/openvideoalliance/user_generated_gallery/kaltura_client_v3/KalturaClient.php"); 
	
	//define constants in ksu-settings.php
  include "/home/openvideoalliance/user_generated_gallery/ksu-settings.php";

	//define session variables
	$partnerUserID          = 'openvideoconference.tv';

	//Construction of Kaltura objects for session initiation
	$config           = new KalturaConfiguration(KALTURA_PARTNER_ID);
	$client           = new KalturaClient($config);
	$ks               = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_SECRET, $partnerUserID, KalturaSessionType::USER);
	//$ks               = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_ADMIN_SECRET, $partnerUserID, KalturaSessionType::ADMIN);

	$flashVars = array();
	$flashVars["uid"]   = $partnerUserID; 
	$flashVars["partnerId"] 		        = KALTURA_PARTNER_ID;
	$flashVars["subPId"] 		        = KALTURA_PARTNER_ID*100;
	$flashVars["entryId"] 	 = -1;	     
	$flashVars["ks"]   = $ks; 
	$flashVars["conversionProfile"]   = 5; 
	$flashVars["maxFileSize"]   = 250; 
	$flashVars["maxTotalSize"]   = 5000; 
	$flashVars["uiConfId"]   = 11500; 
	$flashVars["jsDelegate"]   = "delegate"; 
?>


<?php get_header(); ?>

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="http://www.openvideoconference.org/wp-content/themes/ovcclassic/style.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="http://www.openvideoconference.org/user_generated_gallery/style.css" type="text/css" media="screen" /> 


<div id="gallery">
		<div id="upload-now">
      <p align="right">
			  <a href="#" id="start-upload" onclick="showUpload()">Upload a Video</a>
      </p>
		</div>
    <div class="video-highlight box270">
        <div id="video-player"></div>
    </div>
    <div class="infobox box270">
        <div id="video-description"></div>
    </div>
    <div id="thumbs-viewport">
        <div id="thumbs-container"></div>
    </div>

    <div class="navbar">
        <span class="left-arrow" id="nav-link-previous">⇦</span>
        <span class="right-arrow" id="nav-link-next">⇨</span>
    </div>

    <div id="mediaRSS" style="display:none">
    </div>
    
    <div id="upload-dialog">
    </div>

</div>
<div id="ksu">
	<div id="flashContainer">
		<form>
			<input id="browse-button" type="button" value="Select a File">
		</form>
		<div id="uploader" style="display:none"> 
		</div>
		<script language="JavaScript" type="text/javascript">
			var params = {
				allowScriptAccess: "always",
				allowNetworking: "all",
				wmode: "transparent"

			};
			var attributes  = {
				id: "uploader",
				name: "KUpload"
			};
			// set flashVar object
			var flashVars = <?php echo json_encode($flashVars); ?>;
			 <!--embed flash object-->
			swfobject.embedSWF("http://www.kaltura.com/kupload/ui_conf_id/11500", "uploader", "200", "30", "9.0.0", "expressInstall.swf", flashVars, params,attributes);
			//swfobject.embedSWF("./KSU.swf", "uploader", "200", "30", "9.0.0", "expressInstall.swf", flashVars, params,attributes);
		</script>
	</div>
	<br/>
    <div id="progress-bar"></div>
	<div id="userInput">
	  <form>
			<input type="text" value="title here" id="titleInput" /><br />
			<input type="text" value="tags here, comma separated" id="tagsInput" /><br />
      <textarea id="descriptionInput">Please enter a description here.

we recommend using Markdown and writing the credits for your video like this:

[Your Name](http://yourwebsite.com "HoverText!")</textarea><br />
      <input id="save-button" type="button" value="Save" 	onclick="saveEntry()">
      <input id="add-button" type="button" value="Complete Upload" 	onclick="titleAndSaveEntry()">
		</form>
    <div id="flash">
    </div>

</div>

<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://html5.kaltura.org/js"></script>  
<script src="http://apis.kaltura.org/kalturaJsClient/kaltura.min.js.php" language="javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/lawnchair/src/Lawnchair.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/lawnchair/src/adaptors/LawnchairAdaptorHelpers.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/lawnchair/src/adaptors/DOMStorageAdaptor.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/showdown.js"></script>


<script type="text/javascript">

// Kaltura Session Key and Partner ID are provided by PHP Kaltura Client on the Server
var ks = "<?php echo $ks;?>";
var kPartnerId = <?php echo KALTURA_PARTNER_ID ?>;

</script>

<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/user_generated_gallery.js"></script>

<?php get_footer(); ?>
