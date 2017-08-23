
$(document).ready(function(){
	/*
	 * Manage active page.
	 */
	var url_page = location.href.toLowerCase();
	$('#main-menu > li > a').each(function(){
		var href = $(this).attr('href');
		console.log(href+" == "+url_page);
		if(href == url_page){
			$(this).parent().addClass('active');
		}
	})
})
