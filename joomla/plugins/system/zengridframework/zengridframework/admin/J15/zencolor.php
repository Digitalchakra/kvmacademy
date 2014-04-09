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

/**
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage	Parameter
 * @since		1.5
 */

class JElementzencolor extends JElement
{

	var	$_name = 'Zencolor';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		if ($zgfEnabled) {

				$class = $node->attributes('class');

				ob_start();

				$img=JUri::root()."plugins/system/zengridframework/admin/assets/colorpicker/images/select.png";
				static $embedded;
				if (!$embedded)
				{
					$css2=JUri::root()."plugins/system/zengridframework/admin/assets/colorpicker/css/colorpicker.css";
					$jspath1=JUri::root()."plugins/system/zengridframework/admin/assets/colorpicker/js/colorpicker.js";
				?>

					<link href="<?php echo $css2;?>" type="text/css" rel="stylesheet" />
					<script src="<?php echo $jspath1;?>"></script>
						<?php $embedded=true; ?>
					<script>
					jQuery(document).ready(function(){

						jQuery('.rainbowbtn').each(function(){
							startCol = jQuery(this).prev('input').val();
							jQuery(this).ColorPicker({
								color: startCol,
								onSubmit: function(hsb, hex, rgb, el) {
									jQuery(el).prev('input').val(hex);
									jQuery(el).val(hex);
									jQuery(el).ColorPickerHide();
									jQuery(el).css('backgroundColor', '#'+ hex);
								},
								onBeforeShow: function () {
									jQuery(this).css('backgroundColor', '#'+ startCol);
								}
							});
							jQuery(this).prev('input').bind('keyup', function(){
								jQuery(this).next('.rainbowbtn').ColorPickerSetColor(jQuery(this).val());
								jQuery(this).next('.rainbowbtn').css('backgroundColor', '#'+ jQuery(this).val());
							});
						});



					});
					</script>
					<?php
				}
					?>


					<label class="<?php echo $class ?>">
				<input name="<?php echo $control_name;?>[<?php echo $name;?>]" type="text" class="inputbox" id="<?php echo  $control_name.$name ?>"	value="<?php echo $value;?>" size="10" />
				<img src="<?php echo $img;?>" id="img<?php echo $name; ?>" alt="[r]" class="rainbowbtn" width="28" height="28"/></label>

				<?php $content=ob_get_contents();
				ob_end_clean();
				return $content;
		}
	}
}
