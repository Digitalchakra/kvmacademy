<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the panel layout override is enabled and is placed in the templates/[your template name]/layout folder.
 */


// no direct access
defined('_JEXEC') or die('Restricted index access'); ?>
	<div id="logo" class="grid_<?php echo $logoCols; ?> <?php echo $logoAlign ?>">
		<div id="logoinner">
			<<?php echo $zen->logoClass; ?>>
				<a href="<?php echo $logoLink ?>" <?php if ($zen->logoType == "text") { ?>class="<?php echo $fontStackLogo ?>" style="font-size:<?php echo $logoFontSize ?>" <?php } ?>>
					<?php if ($zen->logoType == "image" && $isOnward && $logoFile !== "tempLogo.png") {
						// Logo Image in J1.7+ ?>
						<img src="<?php echo $logoFile; ?>" alt="<?php echo $logoAltTag ;?>" />
					<?php }
					elseif ($zen->logoType == "image" && $isOnward && $logoFile == "tempLogo.png") {
						// Temp path for template package ?>
						<img src="templates/<?php echo $this->template; ?>/images/logo/logo.png" alt="<?php echo $logoAltTag ;?>" />
					<?php }
						  elseif ($zen->logoType == "image" && $isPresent) {
							// Logo Image in J1.5 ?>
								<img src="<?php echo $this->baseurl.$logoLocation.'/'.$logoFile; ?>" alt="<?php echo $logoAltTag ;?>" />
					<?php } ?>

					<?php if ($zen->logoType == "text") {
						if (($zen->zentranslate)) {
									echo $logoText;
								}
								else {
									echo JText::_("LOGOTEXT");
								}
						} ?>
				</a>
			</<?php echo $zen->logoClass; ?>>

		<?php if ($enableTagline) { ?>
			<div id="tagline">
				<span style="margin-left:<?php echo $taglineLeft ?>;margin-top:<?php echo $taglineTop ?>;"><?php echo $tagline ?></span>
			</div>
		<?php

			} ?>
		</div>
	</div>
