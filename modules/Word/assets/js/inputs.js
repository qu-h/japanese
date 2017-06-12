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
    

    japaninput.hiragana_bin();
    
    $("a.add-answer").off('click').on('click',function(){
    	var this_row = $(this).parents(".col-md-12");
    	var input_row = this_row.prev("section.col-md-12").clone();
    	input_row.find('input').val('');
    	$( input_row ).insertBefore( this_row );
    	japaninput.hiragana_bin();
    	

    });
});

japaninput = {
		hiragana_bin:function(){
			$( "input[name^='answer[hiragana]'], input[name='word[hiragana]'], input[name=hiragana], input.hirainput" ).each(function() {
		    	wanakana.bind($(this).get(0));
		    });
		}
}