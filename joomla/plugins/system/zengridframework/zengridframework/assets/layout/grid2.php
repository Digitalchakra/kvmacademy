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

	<!-- Second Row Grid -->
	<div id="grid2wrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div class="grid2wrap">

						<?php if ($this->countModules('grid5')) : ?>
							<div id="grid5" class="grid_<?php echo $grid5Cols; ?>">
								<jdoc:include type="modules" name="grid5" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid6')) : ?>
							<div id="grid6" class="grid_<?php echo $grid6Cols; ?> <?php echo $grid6class ?>">
								<jdoc:include type="modules" name="grid6" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid7')) : ?>
							<div id="grid7" class="grid_<?php echo $grid7Cols; ?> <?php echo $grid7class ?>">
								<jdoc:include type="modules" name="grid7" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid8')) : ?>
							<div id="grid8" class="grid_<?php echo $grid8Cols; ?> zenlast">
								<jdoc:include type="modules" name="grid8" style="jbChrome" />
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Second Row Grid -->
