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
	<div id="footerwrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div id="footer">
						<div id="footerLeft" class="grid_<?php echo $footerCols ?>">
							<jdoc:include type="modules" name="footer" style="jbChrome" />
							<?php if ($socialiconsposition == "footer" && $socialicons) { require YOURBASEPATH . "/layout/socialicons.php"; } ?>
						</div>


						<!-- Copyright -->
						<div id="footerRight">
							<?php if (!$removejblogo) { ?>
								<a target="_blank" href="http://www.joomlabamboo.com"><img class="jbLogo" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/jb.png" alt="Joomla Bamboo" /></a>
							<?php } ?>

							<?php if ($customcopyright !== "") {
								echo $customcopyright;
							 } ?>
						</div>
					</div>
				</div> <!-- innerContainer -->
			</div>	<!-- containerBG -->
		</div> <!-- Container -->
	</div>
