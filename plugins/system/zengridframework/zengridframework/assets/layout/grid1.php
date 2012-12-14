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

	<!-- First Row Grid -->
<div id="grid1wrap">
	<div class="container <?php echo $zen->containerPosition ?>">
		<div class="row">
			<div class="inner">
				<div class="grid1wrap">

					<?php if ($this->countModules('grid1')) : ?>
						<div id="grid1" class="grid_<?php echo $grid1Cols; ?>">
							<jdoc:include type="modules" name="grid1" style="jbChrome" />
						</div>
					<?php endif; ?>
					<?php if ($this->countModules('grid2')) : ?>
						<div id="grid2" class="grid_<?php echo $grid2Cols; ?> <?php echo $grid2class ?>">
							<jdoc:include type="modules" name="grid2" style="jbChrome" />
						</div>
					<?php endif; ?>
					<?php if ($this->countModules('grid3')) : ?>
						<div id="grid3" class="grid_<?php echo $grid3Cols; ?> <?php echo $grid3class ?>">
							<jdoc:include type="modules" name="grid3" style="jbChrome" />
						</div>
					<?php endif; ?>
					<?php if ($this->countModules('grid4') or ($socialiconsposition == "grid1" && $socialicons)) : ?>
						<div id="grid4" class="grid_<?php echo $grid4Cols; ?> zenlast">
							<jdoc:include type="modules" name="grid4" style="jbChrome" />
							<?php if ($socialiconsposition == "grid1" && $socialicons) { require YOURBASEPATH . "/layout/socialicons.php"; } ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- First Grid -->
