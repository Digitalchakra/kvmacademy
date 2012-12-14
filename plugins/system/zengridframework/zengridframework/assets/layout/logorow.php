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
	<div id="logowrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
						<?php if ($zen->logoPosition == "logo") {
							require YOURBASEPATH . "/layout/logo.php";
						} ?>
				</div>
			</div>
		</div>
	</div>
