<?php
defined('_JEXEC') or die;

/**
 * Template for Joomla! CMS, created with Artisteer.
 * See readme.txt for more details on how to use the template.
 */



require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';

// Create alias for $this object reference:
$document = & $this;

// Shortcut for template base url:
$templateUrl = $document->baseurl . '/templates/' . $document->template;

// Initialize $view:
$view = $this->artx = new ArtxPage($this);

// Decorate component with Artisteer style:
$view->componentWrapper();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $document->language; ?>" lang="<?php echo $document->language; ?>" dir="ltr">
<head>
 <jdoc:include type="head" />
 <link rel="stylesheet" href="<?php echo $document->baseurl; ?>/templates/system/css/system.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo $document->baseurl; ?>/templates/system/css/general.css" type="text/css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" />
 <!--[if IE 6]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie6.css" type="text/css" media="screen" /><![endif]-->
 <!--[if IE 7]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie7.css" type="text/css" media="screen" /><![endif]-->
 <script type="text/javascript">if ('undefined' != typeof jQuery) document._artxJQueryBackup = jQuery;</script>
 <script type="text/javascript" src="<?php echo $templateUrl; ?>/jquery.js"></script>
 <script type="text/javascript">jQuery.noConflict();</script>
 <script type="text/javascript" src="<?php echo $templateUrl; ?>/script.js"></script>
 <script type="text/javascript">if (document._artxJQueryBackup) jQuery = document._artxJQueryBackup;</script>
</head>
<body>
<div id="kvm-page-background-glare-wrapper">
    <div id="kvm-page-background-glare"></div>
</div>
<div id="kvm-main">
    <div class="cleared reset-box"></div>
<div class="kvm-header">
<div class="kvm-header-position">
    <div class="kvm-header-wrapper">
        <div class="cleared reset-box"></div>
        <div class="kvm-header-inner">
<div class="kvm-logo">
 <h1 class="kvm-logo-name"><a href="<?php echo $document->baseurl; ?>/"><?php echo $this->params->get('siteTitle'); ?></a></h1>
 <h2 class="kvm-logo-text"><?php echo $this->params->get('siteSlogan'); ?></h2>
</div>

        </div>
    </div>
</div>

<?php if ($view->containsModules('user3', 'extra1', 'extra2')) : ?>
<div class="kvm-bar kvm-nav">
<div class="kvm-nav-outer">
<div class="kvm-nav-wrapper">
<div class="kvm-nav-inner">
	<?php if ($view->containsModules('extra1')) : ?>
	<div class="kvm-hmenu-extra1"><?php echo $view->position('extra1'); ?></div>
	<?php endif; ?>
	<?php if ($view->containsModules('extra2')) : ?>
	<div class="kvm-hmenu-extra2"><?php echo $view->position('extra2'); ?></div>
	<?php endif; ?>
	<div class="kvm-nav-center">
	<?php echo $view->position('user3'); ?>
	</div>
</div>
</div>
</div>
</div>
<div class="cleared reset-box"></div>
<?php endif; ?>

</div>
<div class="cleared reset-box"></div>
<div class="kvm-box kvm-sheet">
    <div class="kvm-box-body kvm-sheet-body">
<?php echo $view->position('banner1', 'kvm-nostyle'); ?>
<?php echo $view->positions(array('top1' => 33, 'top2' => 33, 'top3' => 34), 'kvm-block'); ?>
<div class="kvm-layout-wrapper">
    <div class="kvm-content-layout">
        <div class="kvm-content-layout-row">
<div class="kvm-layout-cell kvm-content">

<?php
  echo $view->position('banner2', 'kvm-nostyle');
  if ($view->containsModules('breadcrumb'))
    echo artxPost($view->position('breadcrumb'));
  echo $view->positions(array('user1' => 50, 'user2' => 50), 'kvm-article');
  echo $view->position('banner3', 'kvm-nostyle');
  if ($view->hasMessages())
    echo artxPost('<jdoc:include type="message" />');
  echo '<jdoc:include type="component" />';
  echo $view->position('banner4', 'kvm-nostyle');
  echo $view->positions(array('user4' => 50, 'user5' => 50), 'kvm-article');
  echo $view->position('banner5', 'kvm-nostyle');
?>

  <div class="cleared"></div>
</div>
<?php if ($view->containsModules('right')) : ?>
<div class="kvm-layout-cell kvm-sidebar1">
<?php echo $view->position('right', 'kvm-block'); ?>

  <div class="cleared"></div>
</div>
<?php endif; ?>

        </div>
    </div>
</div>
<div class="cleared"></div>


<?php echo $view->positions(array('bottom1' => 33, 'bottom2' => 33, 'bottom3' => 34), 'kvm-block'); ?>
<?php echo $view->position('banner6', 'kvm-nostyle'); ?>

		<div class="cleared"></div>
    </div>
</div>
<div class="kvm-footer">
    <div class="kvm-footer-body">
        <div class="kvm-footer-center">
            <div class="kvm-footer-wrapper">
                <div class="kvm-footer-text">
                    <?php if ($view->containsModules('copyright')): ?>
                    <?php echo $view->position('copyright', 'kvm-nostyle'); ?>
                    <?php else: ?>
                    <?php ob_start(); ?>
<p>www.digitalchakra.in</p>

<p>Copyright © 2012. All Rights Reserved.</p>
<div class="cleared"></div>
<p class="kvm-page-footer"></p>

                    <?php echo str_replace('%YEAR%', date('Y'), ob_get_clean()); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="cleared"></div>
    </div>
</div>

    <div class="cleared"></div>
</div>

<?php echo $view->position('debug'); ?>
</body>
</html>