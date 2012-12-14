<?php
/*------------------------------------------------------------------------

# default.php - YO Search Module

# ------------------------------------------------------------------------

# author    YOphp

# copyright Copyright (C) 2011 yophp.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.yophp.com

# Technical Support:  Forum - http://www.yophp.com/Forum/

-------------------------------------------------------------------------*/ 
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

?>
<div id="tj_container" class="tj_container">
	<div class="tj_nav">
		<span id="tj_prev" class="tj_prev">Previous</span>
		<span id="tj_next" class="tj_next">Next</span>
	</div>
	<div class="tj_wrapper">
		<ul class="tj_gallery">
			<?php
			for ($i = 0; $i < count($images); $i++) {
				$image	=	$images[$i]; ?>
				<li><a href="<?php echo $image->link; ?>"><img width="119" height="67" src="<?php echo $image->image; ?>" alt="" /></a></li>
			<?php }
			?>
		</ul>
	</div>
</div>
