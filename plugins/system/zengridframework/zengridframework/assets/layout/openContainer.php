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
defined('_JEXEC') or die('Restricted index access');
?>

<div class="fullwrap<?php if ($mobilemenu == "1") { ?> selectmenu<?php }?><?php if ($mobilemenu == "2") { ?> togglemenu<?php }?>">

	<?php // Toggle Menu for small screens
		if ($mobilemenu == "2" && $this->countModules('togglemenu')) {
	?>
	<div id="togglemenu">
		<div id="togglemenutrigger">
			<?php echo $mobileMenuTitle ?>
		</div>
		<div id="togglemenucontent">
			<jdoc:include type="modules" name="togglemenu" style="jbChrome" />
		</div>
	</div>
	<?php } ?>
