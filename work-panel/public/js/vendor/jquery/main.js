
var jspath  ='js/$$/vendor',
	csspath ='css/vendor';

require([], function() {

	window.addEvent('domready', function() {
		
		/**
		 * menu
		 */
		if( $$('.ul_menus').length>0 ){

			$$('.ul_menus .group .padre') .addEvent ( 'click' ,function(){
		
				if(0)
				if(this.getParent().hasClass('selected')){

					this.getParent().removeClass('selected');

				} else {
					
					this.getParent().addClass('selected');

				}

			});

		}

		/**
		 * 
		 */
	

	});

});

/**
 * helpers
 */
function loadCss(url) {

    var newCSS = document.createElement("link");
        newCSS.type = "text/css";
        newCSS.rel  = "stylesheet";
        newCSS.href = encodeURI(url);

     document.getElementsByTagName("head")[0].appendChild(newCSS);

}








