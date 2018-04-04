<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.jflatui
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$lang            = JFactory::getLanguage();
$this->language  = $doc->language;
$this->direction = $doc->direction;
$input           = $app->input;
$user            = JFactory::getUser();



// commit tool
// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/slidebars.js');

$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template' . ($this->direction == 'rtl' ? '-rtl' : '') . '.css');

// Load specific language related CSS
$file = 'language/' . $lang->getTag() . '/' . $lang->getTag() . '.css';

if (is_file($file))
{
	$doc->addStyleSheetVersion($file);
}

// Detecting Active Variables
$option   = $input->get('option', '');
$view     = $input->get('view', '');
$layout   = $input->get('layout', '');
$task     = $input->get('task', '');
$itemid   = $input->get('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename', ''), ENT_QUOTES, 'UTF-8');
$cpanel   = ($option === 'com_cpanel');

$hidden = JFactory::getApplication()->input->get('hidemainmenu');

$showSubmenu          = false;
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

// Logo file
if ($this->params->get('logoFile'))
{
	$logo = JUri::root() . $this->params->get('logoFile');
}
else
{
	$logo = $this->baseurl . '/templates/' . $this->template . '/images/logo.png';
}

// Template Parameters
$displayHeader = $this->params->get('displayHeader', '1');
$statusFixed   = $this->params->get('statusFixed', '1');
$stickyToolbar = $this->params->get('stickyToolbar', '1');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta
  name="viewport"
  content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="<?php echo $this->baseurl . '/templates/' . $this->template; ?>/css/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<jdoc:include type="head" />
<script src="<?php echo $this->baseurl . '/templates/' . $this->template; ?>/js/dateformat.js" cache="false"></script>

<!--[if lt IE 9]>
	<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->

</head>

<body>



<?php include 'sidenav.php'; ?>
<div id="sb-site">
<?php include 'nav.php'; ?>
  <div class="wrapper">
    <div id="messages">
      <jdoc:include type="message" />
    </div>
															<jdoc:include type="modules" name="title" style="no" />
  
    <jdoc:include type="modules" name="submenu"/>
    <div class="body_wrapper">
      <div class="body_container">
        <jdoc:include type="modules" name="dashboard" />
		<jdoc:include type="component" />
		
      </div>
    </div>
    <div class="clearfix"></div>
    <span class="footer">
    <jdoc:include type="modules" name="footer" style="no" />
    &copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>.</span> </div>
  <jdoc:include type="modules" name="debug" style="none" />
  <?php if ($stickyToolbar) : ?>
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
  <?php endif; ?>
</div>
</body>
</html>
