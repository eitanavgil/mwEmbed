<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Kaltura
*/
?>

<?php get_header(); ?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<div id="galleryTabs"></div>
<div id="galleryIframe"></div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">

  $(function() {
          $("#galleryTabs").tabs();
            });

</script>

<?php get_footer(); ?>
