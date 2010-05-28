<?php

/**
* Simple tool for packing mwEmbed with license from an up-to-date source
*/

// Parse the request for a preset package:
if( !isset( $_GET['name'] ) ){
	die( 'Please supply a package name' );
}

$packageName = $_GET['name'];

// This class list is used to create a static files in the html5 player package
$html5PlayerClassList = array(
	// Core library ( includes core components and loader)
 	'mwEmbed',

	// jquery css UI theme support
	'mw.style.jqueryUiRedmond',

	// Core Abstract player and skin
	'mw.EmbedPlayer',
	'ctrlBuilder',
	'mw.style.EmbedPlayer',

	// jquery ui and ui-slider
	'j.ui',
	'j.ui.slider',

	// Player Skins
	'kskinConfig',
	'mw.style.kskin',
	'mvpcfConfig',
	'mw.style.mvpcf',

	// Embed Libraries
	'nativeEmbed',
	'javaEmbed',
	'vlcEmbed',
	'kplayerEmbed',
	'genericEmbed',

	// jQuery plugin's used by Embed library
	'j.cookie',

	// TimedText Module
	'mw.TimedText',
	'mw.style.TimedText',
	'j.fn.menu',
	'mw.style.jquerymenu',

);

// Switch among requested packages:
switch( $packageName ) {
	case 'dreamweaver-html5player':
		pakageClassList( $packageName,  $html5PlayerClassList );
	break;
	default:
		print "Package Name was not valid";
	exit();
}

// Get the entire string from the deployed version:
function pakageClassList($packageName, $playerClassList ){
	$zip = new ZipArchive();
	$filename = './mwEmbed-' . $packageName . time() . '.zip';

	if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    	exit("cannot open <$filename>\n");
	}

	define( 'SCRIPTLOADER_MEDIAWIKI', true);
	define( 'DO_MAINTENANCE', true);

	// change to the mwEmbed Directory
	chdir( '../mwEmbed/' );

	// Load the script loader:
	require_once( 'jsScriptLoader.php' );

	// Load the no-mediawiki config ( we have a hybrid no-mediaWiki config setup )
	require_once( 'includes/noMediaWikiConfig.php' );

	// Override some values from no-mediawikiConfig
	global $wgUseMwEmbedLoaderModuleList, $wgUseGzip,
	$wgExtensionJavascriptModules, $IP, $wgScriptLoaderRelativeCss;

	// Use relative css for the package
	$wgScriptLoaderRelativeCss = true;

	$IP = realpath( dirname( __FILE__ ) . '/../mwEmbed' ) ;

	$wgUseMwEmbedLoaderModuleList = false;

	// Disable gzip for package
	$wgUseGzip = false;
	$wgExtensionJavascriptModules = array(
		'EmbedPlayer' => 'modules/EmbedPlayer',
		'TimedText'	=> 'modules/TimedText'
	);

	// Get the combined javascript: ( setup the packaged class list )
	$_GET['class'] = implode(',', $playerClassList);
	$myScriptLoader = new jsScriptLoader();

	ob_start();
	// Run jsScriptLoader action:
	if( !$myScriptLoader->outputFromCache() ){
		$myScriptLoader->doScriptLoader();
	}
	$scriptOutput = ob_get_clean();

	// Output the static package to zip file
	file_put_contents( '../mwEmbed/mwEmbed-player-static.js', $scriptOutput );

	// Loop over the directories if we find an "image" add it to the zip file with full path
	// *yea static above should be js driven*
	//$objects = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $moduleAbsoultePath ), RecursiveIteratorIterator::SELF_FIRST );

	// Get all the skin images in appropriate paths

	//$zip->addFile(
	//$zip->addFromString("mwEmbed/mwEmbed-player-static.js" , $mwEmbedStatic);
	//die();
}


/*

$zip->addFromString("testfilephp.txt", "#1 This is a test string added as testfilephp.txt.\n");
$zip->addFromString("testfilephp2.txt", "#2 This is a test string added as testfilephp2.txt.\n");
$zip->addFile($thisdir . "/too.php","/testfromfile.php");
echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();

*/
// Set Download header

?>