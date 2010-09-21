<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
//var requiredMajorVersion = ${version_major};
// Minor version of Flash required
//var requiredMinorVersion = ${version_minor};
// Minor version of Flash required
//var requiredRevision = ${version_revision};
// -----------------------------------------------------------------------------
// -->

	var app;
	var delegate = {};
  var title;
  var tags;

	//KUploader callbacks
	delegate.readyHandler = function()
	{
		app = document.getElementById("uploader");
    uploaderIsReady();
	}

	delegate.selectHandler = function()
	{
		console.log("selectHandler()");
		console.log(app.getTotalSize());
    upload();
    $('#browse-button').attr("disabled", "true");
    $('#progress-bar').progressbar({ value: 0 });
	}

	delegate.singleUploadCompleteHandler = function(args)
	{
		console.log("singleUploadCompleteHandler", args[0].title);
	}

	delegate.allUploadsCompleteHandler = function()
	{
		console.log("title: " + title + " & tags: " + tags);
    console
    if (title && tags) {
      console.log("we have title");
      setTitle(title);
      console.log("we have tags");
      setTagsFromForm();
      console.log("we will save");
      addEntries();
      }
    else {
      flashAdvice("please title and tag your video");
      $("#save-button").hide();
      $("#add-button").show();
      }
	}

	delegate.entriesAddedHandler = function(entries)
	{
		flashAdvice("Thank you for your upload.\n You may now close this dialog.");
    console.log(entries[0].entryId);
	}

	delegate.progressHandler = function(args)
	{ 
    var uploadProgress = ( args[0] / args[1] ) * 100;
    $("#progress-bar").progressbar( "option", "value", uploadProgress );
//		console.log(args[2].title + ": " + args[0] + " / " + args[1]);
	}

	delegate.uiConfErrorHandler = function()
	{
		console.log("ui conf loading error");
	}

	//KUplaoder API calls

	function upload()
	{
		app.upload();
	}

	function setTags(tags, startIndex, endIndex)
	{
		app.setTags(tags, startIndex, endIndex);
	}

	function addTags(tags, startIndex, endIndex)
	{
		app.addTags(tags, startIndex, endIndex);
	}
	function setTitle(title, startIndex, endIndex)
	{
		app.setTitle(title, startIndex, endIndex);
	} 

	function getFiles()
	{
		var files = app.getFiles();
		console.log(files[0].title);
	}

	function addEntries()
	{
		app.addEntries();
	}

	function stopUploads()
	{
		app.stopUploads();
	}

	function setMaxUploads(value)
	{
		app.setMaxUploads(value);
	}

	function browse()
	{
		app.browse();
	}

	function setPartnerData(value)
	{
		app.setPartnerData(value);
	}

	//End of KUploder API calls
	//--------------------------------------------------------------------

	function setMediaType(mediaType)
	{
//		var mediaType = mediaTypeInput.value;
		app.setMediaType(mediaType);
	}

	function addTagsFromForm()
	{
		//var tags = document.getElementById("tagsInput").value.split(",");
	  var tags = "ovctvugc, 2010, " + document.getElementById("tagsInput").value
    tags = tags.split(",");	
    //var startIndex //= parseInt(tagsStartIndex.value);
		//var endIndex //= parseInt(tagsEndIndex.value);
		addTags(tags, startIndex, endIndex);
	}

	function setTagsFromForm()
	{
		var tags = "ovctvugc, 2010, " + document.getElementById("tagsInput").value
    tags = tags.split(",");
		//var startIndex = parseInt(tagsStartIndex.value);
		//var endIndex = parseInt(tagsEndIndex.value);
		setTags(tags, 0, 0);
	}

	function setTitleFromForm()
	{
		//var startIndex //= parseInt(titleStartIndex.value);
		//var endIndex //= parseInt(titleEndIndex.value);
		setTitle(titleInput.value, 0, 0);
	}

  function saveTags(tags)
	{
    console.log(tags);
		var tagsArray = tags.split(",");
		//var startIndex = parseInt(tagsStartIndex.value);
		//var endIndex = parseInt(tagsEndIndex.value);
		setTags(tagsArray, 0, 0);
	}


  function saveTitle(title)
	{
		//var startIndex //= parseInt(titleStartIndex.value);
		//var endIndex //= parseInt(titleEndIndex.value);
		setTitle(title, 0, 0);
	}


	function removeFilesFromForm()
	{
		var startIndex = parseInt(removeStartIndex.value);
		var endIndex = parseInt(removeEndIndex.value);
		app.removeFiles(startIndex, endIndex)
		console.log(app.getTotalSize());
	}

	function setGroupId(value)
	{
		app.setGroupId(value);
	}

	function setPermissions(value)
	{
		app.setPermissions(value);
	}

	function setSiteUrl(value)
	{
		app.setSiteUrl(value);
	}

	function setScreenName(value)
	{
		app.setScreenName(value);
	}



	var tagsInput;
	var tagsStartIndex;
	var tagsEndIndex;

	var titleInput;
	var titleStartIndex;
	var titleEndIndex;

	var removeStartIndex;
	var removeEndIndex;
	var maxUploadsInput;

	var partnerDataInput;

	var groupId;
	var permissions;
	var screenName;
	var siteUrl;

	function onLoadHandler()
	{

      $("#add-button").hide();
		  
    tagsInput = document.getElementById("tagsInput");
		tagsStartIndex = 0; //document.getElementById("tagsStartIndex");
		tagsEndIndex = 0; //document.getElementById("tagsEndIndex");

		titleInput = document.getElementById("titleInput");
		titleStartIndex = 0; //document.getElementById("titleStartIndex");
		titleEndIndex = 0; //document.getElementById("titleEndIndex");

//		removeStartIndex = document.getElementById("removeStartIndex");;
//		removeEndIndex = document.getElementById("removeEndIndex");

//		maxUploadsInput = document.getElementById("maxUploadsInput");
//		partnerDataInput = document.getElementById("partnerDataInput");

//		groupId = document.getElementById("groupId");
//		permissions = document.getElementById("permissions");
//		screenName = document.getElementById("screenName");
//		siteUrl = document.getElementById("siteUrl");
	}


function uploaderIsReady() {
  console.log(app);
	setMediaType("video");
  }

function saveEntry() {
  title = titleInput.value;
  tags = tagsInput.value;
  console.log(tags);
  saveTitle(title);
  saveTags(tags);
  console.log("titled: " + title + " & tagged: + tags");
  $('#save-button').attr("disabled", "true");
  }

function titleAndSaveEntry() {
  saveEntry();
  addEntries();
  }

function flashAdvice( advice ) {
  $("#flash").hide();
  $("#flash").html("<p>" + advice + "</p>");
  $("#flash").show('slow');
  }


