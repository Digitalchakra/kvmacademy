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

// This file is called if the grid6 layout override is enabled and is placed in the templates/[your template name]/layout folder.

// no direct access
defined('_JEXEC') or die('Restricted index access');
?>

<!-- Sixth Row Grid -->
<div id="grid6wrap">
	<div class="container <?php echo $zen->containerPosition ?>">
		<div class="row">
			<div class="inner">
				<div class="grid6wrap">

						<?php if ($this->countModules('grid21')) : ?>
								<div id="grid21" class="grid_<?php echo $grid21Cols; ?>">
										<jdoc:include type="modules" name="grid21" style="jbChrome" />
								</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid22')) : ?>
								<div id="grid22" class="grid_<?php echo $grid22Cols; ?> <?php echo $grid22class ?>">
										<jdoc:include type="modules" name="grid22" style="jbChrome" />
								</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid23')) : ?>
								<div id="grid23" class="grid_<?php echo $grid23Cols; ?> <?php echo $grid23class ?>">
										<jdoc:include type="modules" name="grid23" style="jbChrome" />
								</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid24') or ($socialiconsposition == "grid6" && $socialicons)) : ?>
								<div id="grid24" class="grid_<?php echo $grid24Cols; ?> zenlast">
										<jdoc:include type="modules" name="grid24" style="jbChrome" />
										<?php if ($socialiconsposition == "grid6" && $socialicons) { require YOURBASEPATH . "/layout/socialicons.php"; } ?>
								</div>
						<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Sixth Row Grid -->
