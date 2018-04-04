<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$lang = JFactory::getLanguage();

// Color Params
$headerColor   = $this->params->get('headerColor', '#184A7D');
$templateColor = $this->params->get('templateColor', '#13294A');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.tooltip');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Load specific language related CSS
$file = 'language/' . $lang->getTag() . '/' . $lang->getTag() . '.css';

if (is_file($file))
{
	$doc->addStyleSheet($file);
}

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
<meta
  name="viewport"
  content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<jdoc:include type="head" />
	<script type="text/javascript">
       	    jQuery(function($) {
            	$( "#form-login input[name='username']" ).focus();
            });
	</script>

	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
	</head>

	<body id="login-container">
    <div class="row">
    <div class="col-sm-4"></div>
        <div class="col-sm-4 col-xs-12">
        
        <div id="login">
      <div class="logo-center"> <a href="index.html"><img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/joomla.png" alt=""></a> </div>
      <jdoc:include type="message" />
      <div class="wrapper-login">
    <jdoc:include type="component" />
  </div>
    </div>
        
        </div>
    <div class="col-sm-4"></div>

    </div>
    

<noscript>
    <?php echo JText::_('JGLOBAL_WARNJAVASCRIPT'); ?>
    </noscript>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
