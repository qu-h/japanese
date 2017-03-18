/**
 *
 */

jQuery(document).ready(function() {
	var audio = new Audio();

	jQuery('.mp3').click(function(){
		audio.src = jQuery(this).attr('src')
		audio.play();
	});

	jQuery('.listen').click(function(){
		
		if( jQuery(this).attr('code').length > 0 ){
			$code = jQuery(this).attr('code');
		} else {
			$code = jQuery(this).parent('.character').find('.r').attr('code');	
		}
		
		audio.src = '//'+window.location.hostname+'/sound/syllabary/'+$code+'.mp3';
		audio.play();
	});

	jQuery('.write').click(function(){
		$code = jQuery(this).parent('.character').find('.r').attr('code');
		window.location.href = '//'+window.location.hostname+'/syllabary/draw/'+$code;
	});

	

	var $draw = jQuery('.japandraw');
	if( $draw.length > 0 ){
		jQuery( ".writing" ).each(function( index ) {
			audio.src = '//'+window.location.hostname+'/sound/syllabary/'+jQuery(this).attr('code')+'.mp3';
			audio.play();
			//var dmak = jQuery(this).dmak(jQuery(this).attr('char'),{'uri':'//'+window.location.hostname+'/svg/'+jQuery(this).attr('group')+'/'});
			var dmak = new Dmak(jQuery(this).attr('char'), {'element': jQuery(this).attr('id'), "uri": '//'+window.location.hostname+'/svg/'+jQuery(this).attr('group')+'/'});

			$draw.find('a.play').click(function(){
				dmak.render();
			});
			$draw.find('a.stop').click(function(){
				dmak.pause();
			});

			$draw.find('a.pre').click(function(){
				dmak.eraseLastStrokes();
			});
			$draw.find('a.next').click(function(){
				dmak.renderNextStrokes();
			});

			
	  
		});
		
	}
});
