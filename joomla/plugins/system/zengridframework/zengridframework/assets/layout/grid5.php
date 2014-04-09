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


defined('_JEXEC') or die('Restricted index access');
?>
	<!-- Fifth Row Grid -->
	<div id="grid5wrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div class="grid5wrap">

								<?php if ($this->countModules('grid17')) : ?>
									<div id="grid17" class="grid_<?php echo $grid17Cols; ?>">
										<jdoc:include type="modules" name="grid17" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if ($this->countModules('grid18')) : ?>
									<div id="grid18" class="grid_<?php echo $grid18Cols; ?> <?php echo $grid18class ?>">
										<jdoc:include type="modules" name="grid18" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if ($this->countModules('grid19')) : ?>
									<div id="grid19" class="grid_<?php echo $grid19Cols; ?> <?php echo $grid19class ?>">
										<jdoc:include type="modules" name="grid19" style="jbChrome" />
									</div>
								<?php endif; ?>
								<?php if ($this->countModules('grid20')) : ?>
									<div id="grid20" class="grid_<?php echo $grid20Cols; ?> zenlast">
										<jdoc:include type="modules" name="grid20" style="jbChrome" />
									</div>
								<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fifth Row Grid -->
