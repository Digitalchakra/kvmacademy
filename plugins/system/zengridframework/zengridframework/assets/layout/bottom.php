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
<!-- Bottom Row bottom -->
<div id="bottomrow">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
						<div id="bottom">
							<?php if ($this->countModules('bottom1')) : ?>
								<div id="bottom1" class="grid_<?php echo $bottom1Cols; ?>">
									<jdoc:include type="modules" name="bottom1" style="jbChrome" />
								</div>
							<?php endif; ?>
							<?php if ($this->countModules('bottom2')) : ?>
								<div id="bottom2" class="grid_<?php echo $bottom2Cols; ?> <?php echo $bottom2class ?>">
									<jdoc:include type="modules" name="bottom2" style="jbChrome" />
								</div>
							<?php endif; ?>
							<?php if ($this->countModules('bottom3')) : ?>
								<div id="bottom3" class="grid_<?php echo $bottom3Cols; ?> <?php echo $bottom3class ?>">
									<jdoc:include type="modules" name="bottom3" style="jbChrome" />
								</div>
							<?php endif; ?>
							<?php if ($this->countModules('bottom4')) : ?>
								<div id="bottom4" class="grid_<?php echo $bottom4Cols; ?> <?php echo $bottom4class ?>">
									<jdoc:include type="modules" name="bottom4" style="jbChrome" />
								</div>
							<?php endif; ?>
							<?php if ($this->countModules('bottom5')) : ?>
								<div id="bottom5" class="grid_<?php echo $bottom5Cols; ?> <?php echo $bottom5class ?>">
									<jdoc:include type="modules" name="bottom5" style="jbChrome" />
								</div>
							<?php endif; ?>
							<?php if ($this->countModules('bottom6') or ($socialiconsposition == "bottom" && $socialicons)) : ?>
								<div id="bottom6" class="grid_<?php echo $bottom6Cols; ?> zenlast">
									<jdoc:include type="modules" name="bottom6" style="jbChrome" />
									<?php if ($socialiconsposition == "bottom" && $socialicons) { require YOURBASEPATH . "/layout/socialicons.php"; } ?>
								</div>
							<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Bottom Row bottom -->
