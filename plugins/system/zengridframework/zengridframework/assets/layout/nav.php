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

	<!-- Nav wrapper -->
	<div id="navwrap">
		<div class="topmenu container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div id="navwrapper" >
						<?php if ($zen->logoPosition == "top") {
								require YOURBASEPATH . "/layout/logo.php";
						} ?>

							<div id="nav" class="grid_<?php echo $navCols; ?> <?php echo $fontStackNav ?> <?php echo $navposition ?>">
								<?php if ($splitMenu && $splitMenuNavPos == "topmenu") {
								require YOURBASEPATH . "/layout/splitmenuTop.php";

								} else { ?>
									<div id="menuwrap" <?php if ($mobilemenu) { ?>class="hide"<?php } ?>>
										<jdoc:include type="modules" name="menu" style="jbChrome" />
									</div>
									<?php if ($mobilemenu == "1") { ?>
										<div id="mobilemenu" title="<?php echo $mobileMenuTitle?>"></div>
									<?php }
								} ?>
							</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<!-- Nav wrapper -->
