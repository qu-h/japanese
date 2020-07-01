jQuery( document ).ready(function() {
	jQuery( "input[name='word']" ).each(function() {
    	wanakana.bind(jQuery(this).get(0));
    });
	
	jQuery('.typeaheadcomplate').typeahead({
        ajax: '/word.json',
        onSelect: displayResult
    });
});

function displayResult(item) {
	jQuery("input[name=word_id]").val(item.value);
    //$('.alert').show().html('You selected <strong>' + item.value + '</strong>: <strong>' + item.text + '</strong>');
}

