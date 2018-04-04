<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$lang            = JFactory::getLanguage();
$this->language  = $doc->language;
$this->direction = $doc->direction;
$input           = $app->input;
$user            = JFactory::getUser();

// Detecting Active Variables
$option   = $input->get('option', '');
$view     = $input->get('view', '');
$layout   = $input->get('layout', '');
$task     = $input->get('task', '');
$itemid   = $input->get('Itemid', '');
$sitename = $app->get('sitename');

$cpanel = ($option === 'com_cpanel');

$showSubmenu = false;
$this->submenumodules = JModuleHelper::getModules('submenu');
foreach ($this->submenumodules as $submenumodule)
{
	$output = JModuleHelper::renderModule($submenumodule);
	if (strlen($output))
	{
		$showSubmenu = true;
		break;
	}
}
$hidden = JFactory::getApplication()->input->get('hidemainmenu');

// Logo file
if ($params->get('logoFile'))
{
	$logo = JUri::root() . $params->get('logoFile');
}
else
{
	$logo = $this->baseurl . '/templates/' . $this->template . '/images/logo.png';
}

// Template Parameters
$displayHeader = $params->get('displayHeader', '1');
$statusFixed   = $params->get('statusFixed', '1');
$stickyToolbar = $params->get('stickyToolbar', '1');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
<link href="<?php echo $this->baseurl . '/templates/' . $this->template; ?>/css/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->baseurl . '/templates/' . $this->template; ?>/css/template.css" rel="stylesheet" type="text/css" />

<script src="<?php echo JUri::root(true); ?>/media/jui/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/jquery-noconflict.js" type="text/javascript"></script>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/template.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
    

<!--[if lt IE 9]>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
    

</head>

<body>
<div class="subhead">
  <div class="top_nav">
    <div class="wrapper-menu">
      <div class="wrapper-inner">
        <div class="logo"></div>
        <div id="menuwrapper" class="pull-left">
        
<?php $this->menumodules = JModuleHelper::getModules('menu'); ?>
					<?php foreach ($this->menumodules as $menumodule) : ?>
						<?php $output = JModuleHelper::renderModule($menumodule, array('style' => 'none')); ?>
						<?php $params = new Registry; ?>
						<?php $params->loadString($menumodule->params); ?>
						<?php echo $output; ?>
					<?php endforeach; ?>          <div class="clearfix"></div>
        </div>
        <div id="user-menu" class="pull-right">
          <ul class="" id="menu">
            <li class="dropdown"> <a class="<?php echo ($hidden ? ' disabled' : 'dropdown-toggle'); ?>" data-toggle="<?php echo ($hidden ? '' : 'dropdown'); ?>" <?php echo ($hidden ? '' : 'href="#"'); ?>><span class="icon-cog"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <?php if (!$hidden) : ?>
                <li> <span> <span class="icon-user"></span> <strong><?php echo $user->name; ?></strong> </span> </li>
                <li class="divider"></li>
                <li> <a href="index.php?option=com_admin&amp;task=profile.edit&amp;id=<?php echo $user->id; ?>"><?php echo JText::_('TPL_ISIS_EDIT_ACCOUNT'); ?></a> </li>
                
                                <li> <a href="../"  target="_blank">View Site</a> </li>

                <li class="divider"></li>
                <li class=""> <a href="<?php echo JRoute::_('index.php?option=com_login&task=logout&' . JSession::getFormToken() . '=1'); ?>"><?php echo JText::_('TPL_ISIS_LOGOUT'); ?></a> </li>
                <?php endif; ?>
              </ul>
            </li>
          </ul>
        </div>
        <div class="free-space-container pull-right">
          <jdoc:include type="modules" name="status" style="no" />
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
</div>

<div class="wrapper">
  <div id="messages">
    <jdoc:include type="message" />
  </div>
  <jdoc:include type="modules" name="submenu"/>
  <div class="body_wrapper">
    
    <div class="body_container">

    
    
<div class="error-text">
						<!-- Begin Content -->
						<h1 class="page-header"><?php echo JText::_('JERROR_AN_ERROR_HAS_OCCURRED'); ?></h1>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						</blockquote>
						<p><a href="<?php echo $this->baseurl; ?>" class="btn btn-success"><i class="icon-dashboard"></i> <?php echo JText::_('JGLOBAL_TPL_CPANEL_LINK_TEXT'); ?></a></p>
						<!-- End Content -->
					</div>    </div>
  </div>
  <div class="clearfix"></div>
  <span class="footer"><jdoc:include type="modules" name="footer" style="no" />
 &copy;  <?php echo date('Y'); ?> <?php echo $sitename; ?>. All Rights Reserved.Designed & Powered By Kenosis Solution
</span>
  
</div>
<jdoc:include type="modules" name="debug" style="none" />
<script>
		jQuery(function($)
		{

			var navTop;
			var isFixed = false;

			processScrollInit();
			processScroll();

			$(window).on('resize', processScrollInit);
			$(window).on('scroll', processScroll);

			function processScrollInit()
			{
				if ($('.subhead').length) {
					navTop = $('.subhead').length && $('.subhead').offset().top - <?php echo ($displayHeader || !$statusFixed) ? 30 : 20;?>;
	
					// Only apply the scrollspy when the toolbar is not collapsed
					if (document.body.clientWidth > 480)
					{
						$('.subhead-collapse').height($('.subhead').height());
						$('.subhead').scrollspy({offset: {top: $('.subhead').offset().top - $('nav.navbar').height()}});
					}
				}
			}

			function processScroll()
			{
				if ($('.subhead').length) {
					var scrollTop = $(window).scrollTop();
					if (scrollTop >= navTop && !isFixed) {
						isFixed = true;
						$('.subhead').addClass('subhead-fixed');
					} else if (scrollTop <= navTop && isFixed) {
						isFixed = false;
						$('.subhead').removeClass('subhead-fixed');
					}
				}
			}
		});
	</script>
</body>
</html>
