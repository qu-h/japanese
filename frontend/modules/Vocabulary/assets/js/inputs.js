$( document ).ready(function() {
	/*
	 * https://github.com/WaniKani/WanaKana
	 */
	var hira_input = jQuery("input[name=hiragana]");
    jQuery("input[name=romaji]").change(function(){
    	var romaji = $(this).val();
    	if( hira_input.val().lenght < 1 ){
    		hira_input.val(wanakana.toHiragana(romaji));
    	}
    });
    
    var hira_input_js = document.getElementById('input_hira')
	wanakana.bind(hira_input_js);
    
});