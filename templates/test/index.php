<?php
defined('_JEXEC') or die;

/**
 * Template for Joomla! CMS, created with Artisteer.
 * See readme.txt for more details on how to use the template.
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';

// Create alias for $this object reference:
$document = $this;

// Shortcut for template base url:
$templateUrl = $document->baseurl . '/templates/' . $document->template;

Artx::load("Artx_Page");

// Initialize $view:
$view = $this->artx = new ArtxPage($this);

// Decorate component with Artisteer style:
$view->componentWrapper();

JHtml::_('behavior.framework', true);

?>
<!DOCTYPE html>
<html dir="ltr" lang="<?php echo $document->language; ?>">
<head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo $document->baseurl; ?>/templates/system/css/system.css" />
    <link rel="stylesheet" href="<?php echo $document->baseurl; ?>/templates/system/css/general.css" />

    <!-- Created by Artisteer v4.0.0.58475 -->
    
    
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.responsive.css" media="all">


    <script>if ('undefined' != typeof jQuery) document._artxJQueryBackup = jQuery;</script>
    <script src="<?php echo $templateUrl; ?>/jquery.js"></script>
    <script>jQuery.noConflict();</script>

    <script src="<?php echo $templateUrl; ?>/script.js"></script>
    <script>if (document._artxJQueryBackup) jQuery = document._artxJQueryBackup;</script>
    <script src="<?php echo $templateUrl; ?>/script.responsive.js"></script>
</head>
<body>

<div id="kvm-main">
<header class="kvm-header clearfix"><?php echo $view->position('position-30', 'kvm-nostyle'); ?>


    <div class="kvm-shapes">
<h1 class="kvm-headline" data-left="3.34%">
    <a href="<?php echo $document->baseurl; ?>/"><?php echo $this->params->get('siteTitle'); ?></a>
</h1>
<h2 class="kvm-slogan" data-left="3.34%"><?php echo $this->params->get('siteSlogan'); ?></h2>


            </div>

<?php if ($view->containsModules('position-1', 'position-28', 'position-29')) : ?>
<nav class="kvm-nav clearfix">
    
<?php if ($view->containsModules('position-28')) : ?>
<div class="kvm-hmenu-extra1"><?php echo $view->position('position-28'); ?></div>
<?php endif; ?>
<?php if ($view->containsModules('position-29')) : ?>
<div class="kvm-hmenu-extra2"><?php echo $view->position('position-29'); ?></div>
<?php endif; ?>
<?php echo $view->position('position-1'); ?>
 
    </nav>
<?php endif; ?>

                    
</header>
<div class="kvm-sheet clearfix">
            <?php echo $view->position('position-15', 'kvm-nostyle'); ?>
<?php echo $view->positions(array('position-16' => 33, 'position-17' => 33, 'position-18' => 34), 'kvm-block'); ?>
<div class="kvm-layout-wrapper clearfix">
                <div class="kvm-content-layout">
                    <div class="kvm-content-layout-row">
                        <div class="kvm-layout-cell kvm-content clearfix">
<?php
  echo $view->position('position-19', 'kvm-nostyle');
  if ($view->containsModules('position-2'))
    echo artxPost($view->position('position-2'));
  echo $view->positions(array('position-20' => 50, 'position-21' => 50), 'kvm-article');
  echo $view->position('position-12', 'kvm-nostyle');
  echo artxPost(array('content' => '<jdoc:include type="message" />', 'classes' => ' kvm-messages'));
  echo '<jdoc:include type="component" />';
  echo $view->position('position-22', 'kvm-nostyle');
  echo $view->positions(array('position-23' => 50, 'position-24' => 50), 'kvm-article');
  echo $view->position('position-25', 'kvm-nostyle');
?>



                        </div>
                        <?php if ($view->containsModules('position-7', 'position-4', 'position-5')) : ?>
<div class="kvm-layout-cell kvm-sidebar1 clearfix">
<?php echo $view->position('position-7', 'kvm-block'); ?>
<?php echo $view->position('position-4', 'kvm-block'); ?>
<?php echo $view->position('position-5', 'kvm-block'); ?>



                        </div>
<?php endif; ?>

                    </div>
                </div>
            </div>
<?php echo $view->positions(array('position-9' => 33, 'position-10' => 33, 'position-11' => 34), 'kvm-block'); ?>
<?php echo $view->position('position-26', 'kvm-nostyle'); ?>


    </div>
<footer class="kvm-footer clearfix"><?php echo $view->position('position-27', 'kvm-nostyle'); ?></footer>

</div>



<?php echo $view->position('debug'); ?>
</body>
</html>