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

<div>
<ul id="countrytabs" class="shadetabs" style="padding-left: 0px; margin-top: -10px;">
<li><a href="http://www.openvideoconference.org/user_generated_gallery/video_library.html" rel="#iframe" title="2009 Video Showcase">ovc2009</a></li>
<li><a href="http://www.openvideoconference.org/user_generated_gallery/ovcUGC.html" rel="#iframe" title="UGC">UGC</a></li>
</ul>
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>

<?php get_footer(); ?>
