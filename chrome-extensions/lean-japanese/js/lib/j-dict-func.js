var ajaxJDict = {
    domain:'//3d44881d.ngrok.io/',
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

    }
});
