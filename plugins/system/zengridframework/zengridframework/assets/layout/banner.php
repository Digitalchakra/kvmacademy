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

<!-- Banner wrapper -->
<div id="bannerwrap">
	<div class="container <?php echo $zen->containerPosition ?>">
		<div class="row">
			<div class="inner">
				<div id="banner" style="width:100%">
						<jdoc:include type="modules" name="banner" style="jbChrome" />
						<?php if ($socialiconsposition == "banner" && $socialicons) { require YOURBASEPATH . "/layout/socialicons.php"; } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Banner wrapper -->
