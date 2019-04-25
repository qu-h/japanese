let wordsElement = document.querySelectorAll(".kotoba");
Array.from(wordsElement).forEach(function(node) {
	node.addEventListener('DOMNodeInserted', getWords);
});

function getWords(){
    let wordsElement = jQuery('.list-kotoba');
    console.log('get words',wordsElement.length,wordsElement[wordsElement.length-1]);
    return 'aa';
    let currentLevel = document.getElementById("grammar-current-level");
    let detail = jQuery('.GrammarDetail');

    let data = {
        level : currentLevel.dataset.value,
        grammar : jQuery('.gmw-wrap .gram',detail).html(),
        title : jQuery('.gmw-wrap .mean',detail).html(),
        using : jQuery('.wpgam-det',detail).html(),
        description : jQuery('.grd-div',detail).html(),
        examples:[]
    };

    let examples = $('.grd-ul li');
    if( examples.length > 0 ) {
        examples.each(function(i,e){
            let phares = [];
            jQuery('.furigana_text',e).each(function(i,p){
                let exp = {
                    content : p.innerHTML,
                    vi: jQuery(p).parents('span').next('p').html(),
                };
                phares.push(exp);
            });
            
            data.examples.push(phares);
        });
    }

    $.ajax({url: ajaxJDict.uri("grammar/update"),data: data});
    console.log('save data',{data});

}
