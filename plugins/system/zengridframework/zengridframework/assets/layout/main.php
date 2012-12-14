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

$zgf = ZenGrid::getInstance();

// no direct access
defined('_JEXEC') or die('Restricted index access');
if (!$zgf->isHome() && !$zen->controlMainArea) {
?>

	<div id="mainwrap">
		<div class="container <?php echo $zen->containerPosition ?>">
			<div class="row">
				<div class="inner">
					<div id="main" class="<?php echo $mainWidth ?>">

						<?php if ($this->countModules('breadcrumb')) : ?>
						<!-- Breadcrumb -->
							<div id="breadcrumb">
									<jdoc:include type="modules" name="breadcrumb" style="jbChrome" />
							</div>
							<div class="clear"></div>
						<!-- End Breadcrumb -->
						<?php endif; ?>

								<?php if ($this->countModules('above') || ($splitMenuAbove && $splitMenu)) : ?>
							<!--  above -->
							<div id="above" class="grid_twelve">
							<?php // Splitmenu:
								if ($splitMenu && $splitMenuAbove) {
									$aboveSplitMenu = $zgf->getSplitMenu($splitMenuName, $splitMenuAboveStart, $splitMenuAboveEnd);
									if ($aboveSplitMenu) {
									echo '<div id="jbSplitMenuAbove">';
									echo $aboveSplitMenu;
									echo '</div>';
								}
							} ?>
											<jdoc:include type="modules" name="above" style="jbChrome" />
									</div>

						<!-- End  above -->
						<div class="clear"></div>

						<?php endif; ?>



						<!-- Main Content -->
							<div id="midCol" class="grid_<?php echo $midCols; ?> <?php echo $mainWidth ?> <?php echo $midColPull ?>">
								<?php if ($zen->logoPosition == "middle") {
									require YOURBASEPATH . "/layout/logo.php";

								}

						if ($advert1 > "0") : ?>
								<!-- Top Advert Row -->
								<div id="abovemain">
										<?php if ($this->countModules('advert1')) : ?>
										<div id="abovemain1" class="grid_<?php echo $advert1 ?>">
												<jdoc:include type="modules" name="advert1" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if ($this->countModules('advert2')) : ?>
										<div id="abovemain2" class="grid_<?php echo $advert1 ?> <?php echo $advert2class ?>">
												<jdoc:include type="modules" name="advert2" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if ($this->countModules('advert3')) : ?>
										<div id="abovemain3"  class="grid_<?php echo $advert1 ?> zenlast">
												<jdoc:include type="modules" name="advert3" style="jbChrome" />
										</div>
										<?php endif; ?>
								</div>
								<!-- Top Advert Row -->
								<?php endif; ?>

								<div class="clear"></div>


								<div id="mainContent"  class="<?php echo $mainWidth ?>">
										<jdoc:include type="message" />
										<jdoc:include type="component" />
								</div>


								<div class="clear"></div>

								<?php if ($advert2 > "0") : ?>
								<!-- Bottom Advert Row -->
										<div id="belowmain">
										<?php if ($this->countModules('advert4')) : ?>
										<div id="belowmain1"  class="grid_<?php echo $advert2 ?>">
												<jdoc:include type="modules" name="advert4" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if ($this->countModules('advert5')) : ?>
										<div id="belowmain2"  class="grid_<?php echo $advert2 ?> <?php echo $advert5class ?>">
												<jdoc:include type="modules" name="advert5" style="jbChrome" />
										</div>
										<?php endif; ?>

										<?php if ($this->countModules('advert6')) : ?>
										<div id="belowmain3"  class="grid_<?php echo $advert2 ?> zenlast">
												<jdoc:include type="modules" name="advert6" style="jbChrome" />
										</div>
										<?php endif; ?>
								</div>
								<?php endif; ?>
						</div>
						<!-- End Main Content -->


							<?php if ($this->countModules('left') || ($splitMenuLeft && $splitMenu)) : ?>
							<!-- Left Column -->
								<div id="leftCol" class="grid_<?php echo $leftCols; ?> <?php echo $mainWidth ?>  <?php echo $leftColPush?>">
										<div id="left" class="sidebar">

											<?php if ($socialiconsposition == "left" && $socialicons) { require YOURBASEPATH . "/layout/socialicons.php"; } ?>

											<?php if ($zen->logoPosition == "left") {
												require YOURBASEPATH  . "/layout/logo.php";

											}

												// Splitmenu: Get all but the first level of the menu "topmenu"
												if ($splitMenu && $splitMenuLeft) {
														$leftSplitMenu = $zgf->getSplitMenu($splitMenuName, $splitMenuLeftStart, $splitMenuLeftEnd);
														if ($leftSplitMenu) {
														echo '<div id="jbSplitMenuLeft">';
														echo '<h3><span>';
															echo $splitMenuLeftTitle;
														echo '</span></h3>';
														echo $leftSplitMenu;
														echo '</div>';
													}

												} ?>

												<jdoc:include type="modules" name="left" style="jbChrome" />
										</div>
								</div>
							<!-- End Left Column -->
							<?php endif; ?>

							<?php if ($this->countModules('center')) : ?>
							<!-- Center Column -->
								<div id="centerCol" class="grid_<?php echo $centerCols; ?> <?php echo $mainWidth ?> <?php echo $centerColPull?>">
										<div id="center" class="sidebar">
												<jdoc:include type="modules" name="center" style="jbChrome" />
										</div>
								</div>
							<!-- End Center Column -->
							<?php endif; ?>



							<?php if ($this->countModules('right') || ($splitMenuRight && $splitMenu)) : ?>
						<!-- Right Column -->
							<div id="rightCol" class="grid_<?php echo $rightCols; ?> <?php echo $mainWidth ?> zenlast">

									<div id="right" class="sidebar">

											<?php if ($splitMenu && $splitMenuRight) {
												$rightSplitMenu = $zgf->getSplitMenu($splitMenuName, $splitMenuRightStart, $splitMenuRightEnd);
												if ($rightSplitMenu) {
												echo '<div id="jbSplitMenuRight">';
												echo '<h3><span>';
												echo $splitMenuRightTitle;
												echo '</h3>';
												echo $rightSplitMenu;
												echo '</span></div>';
												}
											}?>
											<jdoc:include type="modules" name="right" style="jbChrome" />
									</div>
							</div>
						<!-- End Right Column -->
						<?php endif; ?>
						</div>



						<?php if ($this->countModules('below')) : ?>
						<!-- Below -->
						<div class="clear"></div>
						<div id="below"  class="<?php echo $mainWidth ?>">
								<jdoc:include type="modules" name="below" style="jbChrome" />
							</div>
						<!-- End Below -->
						<div class="clear"></div>

						<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
