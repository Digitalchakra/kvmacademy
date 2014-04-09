<?php
defined('_JEXEC') or die;

if (!defined('_ARTX_FUNCTIONS'))
  require_once dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/../functions.php');

function modChrome_artstyle($module, &$params, &$attribs)
{
  $style = isset($attribs['artstyle']) ? $attribs['artstyle'] : 'kvm-nostyle';
  $styles = array(
    'kvm-nostyle' => 'modChrome_artnostyle',
    'kvm-block' => 'modChrome_artblock',
    'kvm-article' => 'modChrome_artarticle',
    'kvm-vmenu' => 'modChrome_artvmenu'
  );
  // moduleclass_sfx support:
  //  '' or 'suffix'   - the default module style: custom suffix will not be added to the module tag
  //                     but will be added to the module elements.
  //  ' suffix'        - adds suffix to the module as well as to the module elements.
  //  'kvm-...'        - overwrites the default module style.
  //  'suffix kvm-...' - overwrites the default style and adds suffix to the module and
  //                     to its elements, does not add kvm-... to the module elements.
  
  $classes = explode(' ', rtrim($params->get('moduleclass_sfx')));
  $keys = array_keys($styles);
  $art = array();
  foreach ($classes as $key => $class) {
    if (in_array($class, $keys)) {
      $art[] = $class;
      $classes[$key] = ' ';
    }
  }
  $classes = str_replace('  ', ' ', rtrim(implode(' ', $classes)));
  $style = count($art) ? array_pop($art) : $style;
  $params->set('moduleclass_sfx', $classes);
  call_user_func($styles[$style], $module, $params, $attribs);
}

function modChrome_artnostyle($module, &$params, &$attribs)
{
if (!empty ($module->content)) : ?>
<!-- begin nostyle -->
<div class="kvm-nostyle<?php echo $params->get('moduleclass_sfx'); ?>">
<?php if ($module->showtitle != 0) : ?>
<h3><?php echo $module->title; ?></h3>
<?php endif; ?>
<!-- begin nostyle content -->
<?php echo $module->content; ?>
<!-- end nostyle content -->
</div>
<!-- end nostyle -->
<?php endif;
}

function modChrome_artblock($module, &$params, &$attribs)
{
  if (!empty ($module->content))
    echo artxBlock(($module->showtitle != 0) ? $module->title : '', $module->content,
      $params->get('moduleclass_sfx'));
}

function modChrome_artvmenu($module, &$params, &$attribs)
{
  if (!empty ($module->content)) {
    if (function_exists('artxVMenuBlock'))
      echo artxVMenuBlock(($module->showtitle != 0) ? $module->title : '', $module->content,
        $params->get('moduleclass_sfx'));
    else
      echo artxBlock(($module->showtitle != 0) ? $module->title : '', $module->content,
        $params->get('moduleclass_sfx'));
  }
}

function modChrome_artarticle($module, &$params, &$attribs)
{
  if (!empty ($module->content)) {
    $data = array('classes' => $params->get('moduleclass_sfx'), 'content' => $module->content);
    if ($module->showtitle != 0)
      $data['header-text'] = $module->title;
    echo artxPost($data);
  }
}
