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
	<!-- Fourth Row Grid -->
	<div id="grid4wrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div class="grid4wrap">

							<?php if ($this->countModules('grid13')) : ?>
									<div id="grid13" class="grid_<?php echo $grid13Cols; ?>">
											<jdoc:include type="modules" name="grid13" style="jbChrome" />
									</div>
							<?php endif; ?>
							<?php if ($this->countModules('grid14')) : ?>
									<div id="grid14" class="grid_<?php echo $grid14Cols; ?> <?php echo $grid14class ?>">
											<jdoc:include type="modules" name="grid14" style="jbChrome" />
									</div>
							<?php endif; ?>
							<?php if ($this->countModules('grid15')) : ?>
									<div id="grid15" class="grid_<?php echo $grid15Cols; ?> <?php echo $grid15class ?>">
											<jdoc:include type="modules" name="grid15" style="jbChrome" />
									</div>
							<?php endif; ?>
							<?php if ($this->countModules('grid16')) : ?>
									<div id="grid16" class="grid_<?php echo $grid16Cols; ?> zenlast">
											<jdoc:include type="modules" name="grid16" style="jbChrome" />
									</div>
							<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div><!-- Fourth Grid -->
