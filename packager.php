<?php

/**
* Simple tool for packing mwEmbed with license from an up-to-date source
*/

// Parse the request for a preset package:
die('still in development');
$packageName = $_GET['name'];

$playerClassList = array(
 	'mwEmbed',
	'$j.ui',
	'mw.style.jqueryUiRedmond',
	'mw.EmbedPlayer',
	'ctrlBuilder',
	'mw.style.EmbedPlayer',
	'$j.cookie',
	'kskinConfig',
	'mw.style.kskin',
	'$j.fn.menu',
	'mw.TimedText',
	'mw.style.TimedText',
	'mw.style.jquerymenu',
	'mvpcfConfig',
	'mw.style.mvpcf',
	'$j.fn.menu',
	'mw.TimedText',
	'mw.style.TimedText',
	'mw.style.jquerymenu',
	'nativeEmbed',
	'$j.fn.menu',
	'mw.style.jquerymenu',
	'$j.ui.slider'
)

switch( $packageName ) {
	case 'dreamweaver-html5player':
		// get all.
		pakageClassList( $playerClassList );
	break;
	case 'dreamweaver-html5player-jquery ':
		// add jQuery
		pakageClassList( array_merge( 'window.jQuery', $playerClassList) );
	break;
	default:
		print "Package Name was not valid"
	exit();
}



$zip = new ZipArchive();
$filename = "./test112.zip";

if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$zip->addFromString("testfilephp.txt" . time(), "#1 This is a test string added as testfilephp.txt.\n");
$zip->addFromString("testfilephp2.txt" . time(), "#2 This is a test string added as testfilephp2.txt.\n");
$zip->addFile($thisdir . "/too.php","/testfromfile.php");
echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();

// Set Download header

?>