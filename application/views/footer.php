<?php

	/*
	 * CSS
	 */
	
	// Global CSS files for all pages.
	//--------------------------------
	echo link_tag(CSS_FOLDER.'style.css');
	echo link_tag(EXTERNAL_ASSETS_FOLDER.'bootstrap/css/bootstrap.css');
	echo link_tag(EXTERNAL_ASSETS_FOLDER.'jquery-ui/jquery-ui.min.css');
	
	// Specific required CSS files for current page.
	//----------------------------------------------
    if(isset($css_load)){
    	foreach($css_load as $css) {
    		echo link_tag($css);
    	}
    }
    
    
    /*
     * JS
     */
    
    // Global Js files for all pages.
    //-------------------------------
    echo script_tag(EXTERNAL_ASSETS_FOLDER.'jquery/jquery.min.js');
    echo script_tag(EXTERNAL_ASSETS_FOLDER.'jquery-ui/jquery-ui.min.js');
    echo script_tag(EXTERNAL_ASSETS_FOLDER.'bootstrap/js/bootstrap.js');
    echo script_tag(EXTERNAL_ASSETS_FOLDER.'select2/select2.min.js');
    
    // Specific required JS files for current page.
    //---------------------------------------------
    if(isset($js_load)){
    	foreach($js_load as $js) {
    		echo script_tag($js);
    	}
    }
    
?>
	</body>
</html>