<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');

if (file_exists(JPATH_ROOT."/templates/$this->template/layout/logo.php"))
{
	require(JPATH_ROOT."/templates/$this->template/layout/logo.php");
}
else { ?>
	<div id="logo" class="grid_<?php echo $zen->logoWidth; ?> <?php echo $zen->logoAlign ?>" style="margin-left:<?php echo $zen->logoLeft ?>;margin-top:<?php echo $zen->logoTop ?>">
		<div id="logoinner">
			<<?php echo $zen->logoClass; ?>>
				<a href="<?php echo $zen->logoLink ?>" <?php if ($zen->logoType == "text") { ?>class="<?php echo $zen->fontStackLogo ?>" style="font-size:<?php echo $zen->logoFontSize ?>" <?php } ?>>
					<?php if ($zen->logoType == "image" && $isOnward && $zen->logoFile !== "tempLogo.png") {
						// Logo Image in J1.7+ ?>
						<img src="<?php echo $zen->logoFile; ?>" alt="<?php echo $zen->logoAltTag ;?>" />
					<?php }
					elseif ($zen->logoType == "image" && $isOnward && $zen->logoFile == "tempLogo.png") {
						// Temp path for template package ?>
						<img src="templates/<?php echo $this->template; ?>/images/logo/logo.png" alt="<?php echo $zen->logoAltTag ;?>" />
					<?php }
						  elseif ($zen->logoType == "image" && $isPresent) {
							// Logo Image in J1.5 ?>
								<img src="<?php echo $this->baseurl.$logoLocation.'/'.$logoFile; ?>" alt="<?php echo $zen->logoAltTag ;?>" />
					<?php } ?>

					<?php if ($zen->logoType == "text") {
						if ($zen->zenTranslate) {
									echo $zen->logoText;
								}
								else {
									echo JText::_("LOGOTEXT");
								}
						} ?>
				</a>
			</<?php echo $zen->logoClass; ?>>

		<?php if ($zen->enableTagline) { ?>
			<div id="tagline">
				<span style="margin-left:<?php echo $zen->taglineLeft ?>;margin-top:<?php echo $zen->taglineTop ?>;"><?php echo $zen->tagline ?></span>
			</div>
		<?php

			} ?>
		</div>
	</div>
<?php }
