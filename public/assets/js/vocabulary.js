
$( document ).ready(function() {
    $('#vocabulary_add_line').click(function(){
    	var pre_line = $(this).parent('section').prev('div.new_row');
    	var row = pre_line.clone();
    	row.find('input[type=text]').val("");

    	$(row).insertAfter(pre_line);

    });
});