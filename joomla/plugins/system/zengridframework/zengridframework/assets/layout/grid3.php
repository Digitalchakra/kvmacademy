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

	<!-- Third Row Grid -->
	<div id="grid3wrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div class="grid3wrap">
						<?php if ($this->countModules('grid9')) : ?>
							<div id="grid9" class="grid_<?php echo $grid9Cols; ?>">
								<jdoc:include type="modules" name="grid9" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid10')) : ?>
							<div id="grid10" class="grid_<?php echo $grid10Cols; ?> <?php echo $grid10class ?>">
								<jdoc:include type="modules" name="grid10" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid11')) : ?>
							<div id="grid11" class="grid_<?php echo $grid11Cols; ?> <?php echo $grid11class ?>">
								<jdoc:include type="modules" name="grid11" style="jbChrome" />
							</div>
						<?php endif; ?>
						<?php if ($this->countModules('grid12')) : ?>
							<div id="grid12" class="grid_<?php echo $grid12Cols; ?> zenlast">
								<jdoc:include type="modules" name="grid12" style="jbChrome" />
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Third Row Grid -->
