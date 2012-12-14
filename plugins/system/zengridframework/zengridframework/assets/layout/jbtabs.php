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

<?php if ($this->countModules('tab1') || $this->countModules('tab2')  || $this->countModules('tab3')  || $this->countModules('tab4')) : ?>
										<!-- Tab Row wrapper -->
										<div id="tabwrap">
											<div class="container <?php echo $zen->containerPosition ?>">
												<div class="row">
													<div class="inner">
															<div id="jbtabbedArea">
																<ul class="jbtabs">
																	<?php if ($this->countModules('tab1')) : ?>
																		<li class="jbtab1" >
																			<a href="#jbtab1">
																				<?php if (($zen->zentranslate)) {
																							echo $tab1Title;
																						}
																						else {
																							echo JText::_("Tab1");
																				} ?>

																				</a>
																		</li>
																	<?php endif; ?>

																	<?php if ($this->countModules('tab2')) : ?>
																		<li class="jbtab2" >
																				<a href="#jbtab2">
																					<?php if (($zen->zentranslate)) {
																								echo $tab2Title;
																							}
																							else {
																								echo JText::_("Tab2");
																					} ?>

																				</a></li>
																	<?php endif; ?>

																	<?php if ($this->countModules('tab3')) : ?>
																		<li class="jbtab3" >
																				<a href="#jbtab3">
																						<?php if (($zen->zentranslate)) {
																									echo $tab3Title;
																								}
																								else {
																									echo JText::_("Tab3");
																						} ?>
																				</a>
																		</li>
																	<?php endif; ?>

																	<?php if ($this->countModules('tab4')) : ?>
																	 <li class="jbtab4" >
																			<a href="#jbtab4">
																					<?php if (($zen->zentranslate)) {
																								echo $tab4Title;
																							}
																							else {
																								echo JText::_("Tab4");
																					} ?>
																			</a>
																		</li>
																	<?php endif; ?>
																</ul>
																<div class="jbtab_container">

																	<?php if ($this->countModules('tab1')) : ?>
																		<div id="jbtab1" class="jbtab_content jbtabwidth<?php echo $tab1Count; ?>">
																			<div class="jbtab1">
																					<jdoc:include type="modules" name="tab1" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>


																	<?php if ($this->countModules('tab2')) : ?>
																		<div id="jbtab2" class="jbtab_content jbtabwidth<?php echo $tab2Count; ?> <?php echo $tab2class ?>">
																			<div class="jbtab2">
																					<jdoc:include type="modules" name="tab2" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>

																	<?php if ($this->countModules('tab3')) : ?>
																		<div id="jbtab3" class="jbtab_content jbtabwidth<?php echo $tab3Count; ?> <?php echo $tab3class ?>">
																			<div class="jbtab3">
																					<jdoc:include type="modules" name="tab3" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>

																	<?php if ($this->countModules('tab4')) : ?>
																		<div id="jbtab4" class="jbtab_content jbtabwidth<?php echo $tab4Count; ?> zenlast">
																			<div class="jbtab4">
																					<jdoc:include type="modules" name="tab4" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>

																   </div>
															</div>

														<div class="clear"></div>

													</div>
												</div>
											</div>
										</div>
										<!-- Tabs wrapper -->
<?php endif; ?>
