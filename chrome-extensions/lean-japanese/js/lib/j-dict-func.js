$.ajaxSetup({
    url: "//300c7631.ngrok.io/kanji/char",
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
