<div class="subhead">
  <div class="top_nav">
    <div class="wrapper-menu">
      <div class="wrapper-inner">
      <a href="#" class="sidebar-toggle-button sb-toggle-left"><i class="fa  fa-bars"></i></a>
        <a href="index.php"><div class="logo"></div></a>
        <div id="menuwrapper" class="pull-left">
        
          <jdoc:include type="modules" name="menu" style="none" />
          <div class="clearfix"></div>
        </div>
        <div id="user-menu" class="pull-right">
          <ul class="" id="menu">
            <li class="dropdown"> <a class="<?php echo ($hidden ? ' disabled' : 'dropdown-toggle'); ?>" data-toggle="<?php echo ($hidden ? '' : 'dropdown'); ?>" <?php echo ($hidden ? '' : 'href="#"'); ?>><span class="icon-cog"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <?php if (!$hidden) : ?>
                <li> <span> <span class="icon-user"></span> <strong><?php echo $user->name; ?></strong> </span> </li>
                <li class="divider"></li>
                <li> <a href="index.php?option=com_admin&amp;task=profile.edit&amp;id=<?php echo $user->id; ?>">Edit Account</a> </li>
                
                                <li> <a href="../"  target="_blank">View Site</a> </li>

                <li class="divider"></li>
                <li class=""> <a href="<?php echo JRoute::_('index.php?option=com_login&task=logout&' . JSession::getFormToken() . '=1'); ?>">Logout</a> </li>
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