console.log('get grammar');

var grammarButtons = document.querySelectorAll(".dekiru-popup-detail");

Array.from(grammarButtons).forEach(function(node) {
	node.addEventListener('DOMNodeInserted', getGrammarDetail);
});


function getGrammarDetail(){
    let currentLevel = document.getElementById("grammar-current-level");
    let detail = jQuery('.GrammarDetail');

    let data = {
        level : currentLevel.dataset.value,
        grammar : jQuery('.gmw-wrap .gram',detail).html(),
        description : jQuery('.gmw-wrap .mean',detail).html(),
        using : jQuery('.wpgam-det',detail).html(),
        note : jQuery('.grd-div',detail).html(),
        example:[]
    };

    let examples = $('.grd-ul li');
    if( examples.length > 0 ) {
        examples.each(function(i,e){
            let phares = [];
            jQuery('.furigana_text',e).each(function(i,p){
                console.log('deee',p);
                let exp = {
                    content : jQuery(this).html(),
                    vi: jQuery('p',e).html(),
                };
            });
            
            //data.example.push(exp);
        });
    }

    
    console.log('save data',{data});

}
