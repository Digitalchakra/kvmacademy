<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');

if (!$zen->socialfonticons) {
?>
	<div id="socialicons" class="<?php echo $socialalign ?> <?php echo $zen->socialiconsposition ?>">
		<?php if ($zen->socialiconstitle !="") {?>
			<h3><span><?php echo $zen->socialiconstitle ?></span></h3>
		<?php } ?>
		<ul>
		<!-- Social Icons -->
		<?php if ($zen->icon1Image !="-1") {?>
		<li><a class="topicons icon1" target="_blank" href="<?php echo $zen->icon1Link ?>">
			<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $zen->icon1Image ?>"  title="<?php echo $zen->icon1Image ?>" alt="<?php echo $zen->icon1Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($zen->icon2Image !="-1") {?>
		<li><a class="topicons icon2" target="_blank" href="<?php echo $zen->icon2Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $zen->icon2Image ?>" title="<?php echo $zen->icon2Image ?>" alt="<?php echo $zen->icon2Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($zen->icon3Image !="-1") {?>
		<li><a class="topicons icon3" target="_blank" href="<?php echo $zen->icon3Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $zen->icon3Image ?>" title="<?php echo $zen->icon3Image ?>"  alt="<?php echo $zen->icon3Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($zen->icon4Image !="-1") {?>
		<li><a class="topicons icon4" target="_blank" href="<?php echo $zen->icon4Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $zen->icon4Image ?>" title="<?php echo $zen->icon4Image ?>"  alt="<?php echo $zen->icon4Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($zen->icon5Image !="-1") {?>
		<li><a class="topicons icon5" target="_blank" href="<?php echo $zen->icon5Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $zen->icon5Image ?>" title="<?php echo $zen->icon5Image ?>"  alt="<?php echo $zen->icon5Image ?>"/>
		</a></li>
		<?php } ?>

		<?php if ($zen->icon6Image !="-1") {?>
		<li><a class="topicons icon6" target="_blank" href="<?php echo $zen->icon6Link ?>">
				<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $zen->icon6Image ?>" title="<?php echo $zen->icon6Image ?>"  alt="<?php echo $zen->icon6Image ?>"/>
		</a></li>
		<?php } ?>
		</ul>
	</div>
<?php } else { ?>
<div id="socialicons" class="<?php echo $zen->socialalign ?> <?php echo $zen->socialiconsposition ?>">
		<?php if ($zen->socialiconstitle !="") {?>
			<h3><span><?php echo $zen->socialiconstitle ?></span></h3>
		<?php } ?>
		<ul>
		<!-- Social Icons -->
		<?php if ($zen->icon1Image !="-1") {?>
		<li>
			<a class="topicons icon1" target="_blank" href="<?php echo $zen->icon1Link ?>">
				<i class="<?php echo $zen->icon1Image; ?>"></i>
			</a>
		</li>
		<?php } ?>

		<?php if ($zen->icon2Image !="-1") {?>
		<li>
			<a class="topicons icon2" target="_blank" href="<?php echo $zen->icon2Link ?>">
				<i class="<?php echo $zen->icon2Image; ?>"></i>
			</a>
		</li>
		<?php } ?>

		<?php if ($zen->icon3Image !="-1") {?>
		<li>
			<a class="topicons icon3" target="_blank" href="<?php echo $zen->icon3Link ?>">
				<i class="<?php echo $zen->icon3Image; ?>"></i>
			</a>
		</li>
		<?php } ?>

		<?php if ($zen->icon4Image !="-1") {?>
		<li>
			<a class="topicons icon4" target="_blank" href="<?php echo $zen->icon4Link ?>">
				<i class="<?php echo $zen->icon4Image; ?>"></i>
			</a>
		</li>
		<?php } ?>

		<?php if ($zen->icon5Image !="-1") {?>
		<li>
			<a class="topicons icon5" target="_blank" href="<?php echo $zen->icon5Link ?>">
				<i class="<?php echo $zen->icon5Image; ?>"></i>
			</a>
		</li>
		<?php } ?>

		<?php if ($zen->icon6Image !="-1") {?>
		<li>
			<a class="topicons icon6" target="_blank" href="<?php echo $zen->icon6Link ?>">
				<i class="<?php echo $zen->icon6Image; ?>"></i>
			</a>
		</li>
		<?php } ?>
		</ul>
	</div>

<?php }
