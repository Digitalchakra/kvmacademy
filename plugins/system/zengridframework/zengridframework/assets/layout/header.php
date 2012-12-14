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

	<!-- Logo wrapper -->
	<div id="headerwrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">

									<?php if ($zen->logoPosition == "above") {
										require YOURBASEPATH . "/layout/logo.php";
									} ?>

									<?php if (!($zen->logoPosition == "above")) { ?>
									<div id="header1"  class="grid_<?php echo $header1Cols; ?>">
											<jdoc:include type="modules" name="header1" style="jbChrome" />
									</div>
									<?php } ?>

									<?php if ($this->countModules('header2')) : ?>
									<div id="header2"  class="grid_<?php echo $header2Cols; ?> <?php echo $header2class ?>">
											<jdoc:include type="modules" name="header2" style="jbChrome" />
									</div>
									<?php endif; ?>

									<?php if ($this->countModules('header3')) : ?>
									<div id="header3"  class="grid_<?php echo $header3Cols; ?> <?php echo $header3class ?>">
											<jdoc:include type="modules" name="header3" style="jbChrome" />
									</div>
									<?php endif; ?>

									<?php if ($this->countModules('header4') or ($socialicons && $socialiconsposition == "header")) : ?>
									<div id="header4"  class="grid_<?php echo $header4Cols; ?> zenlast">
											<jdoc:include type="modules" name="header4" style="jbChrome" />
											<?php if ($socialicons && $socialiconsposition == "header") { require YOURBASEPATH . "/layout/socialicons.php"; } ?>
									</div>
									<?php endif; ?>

							</div>
					</div>
			</div>
	</div>
	<!-- Logo wrapper -->
