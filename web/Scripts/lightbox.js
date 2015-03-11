function lightbox(id){
	var lightbox = document.getElementById(id);
	if( $( lightbox ).data("open") == "close" ) {
		$( lightbox ).data("open","open").fadeIn( 200 );
		$('body').css({'overflow': 'hidden', 'height': '100%' });
	}else{
		
		$( lightbox ).data("open","close").fadeOut( 200 );	
		$('body').css({'overflow': 'scroll', 'height': 'auto' });
	}
}