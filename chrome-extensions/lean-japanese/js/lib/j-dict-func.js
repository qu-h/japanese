var ajaxJDict = {
    domain:'//579da372.ngrok.io/',
    uri:(uri)=>{
        return ajaxJDict.domain + uri;
    }
};

var configjDict = {
    color :{ saved : '#33b874'}
};

$.ajaxSetup({
    url: ajaxJDict.uri("kanji/char"),
    global: false,
    type: "POST",
    crossDomain:true,
    cache:true,
    async:true,
    success: function(msg){
        getKanjiStatus();
        console.log("success :",msg);
        ajaxLoading = false;
    },
    error: function(jxhr){
        console.log("error:",{jxhr});
    },
    complete: function(){
        console.log('ajax is complete 28');    
    }
});

$( document ).ajaxSuccess(function( event, request, settings ) {
    console.log('ajax is complete 33');
});
