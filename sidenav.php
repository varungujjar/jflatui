<script type="text/javascript">
(function($) {
				$(document).ready(function() {
					$.slidebars();
					
	$(".sidebar-nav-left a.dropdown-toggle")
   .each(function()
   { 
      //$(this).attr("href", "#");
        
   });
   
   
   $(document).on("click", ".dropdown-submenu a", function (){
   
  $(this).find("ul").css('display','block');
  
  
				});
   
					
				});
				
			
			
				
				
				
			}) (jQuery);
			
		
			
</script>

<div class="sb-slidebar sb-left">	

        <div class="status-sidebar">

	          <jdoc:include type="modules" name="status" style="no" />
              </div>
		
<div class="sidebar-nav-left">
    <jdoc:include type="modules" name="menu" style="none" />
    <div class="clearfix"></div>                
</div>
            
            
            
            
		</div><!-- /.sb-slidebar .sb-left -->