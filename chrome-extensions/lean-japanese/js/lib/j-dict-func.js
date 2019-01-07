$.ajaxSetup({
    url: "https://api.japanese.giaiphapict.loc/kanji/char.json",
    global: false,
    type: "POST",
    crossDomain:true,
    cache:true,
    async:true,
    success: function(msg){
        getKanjiStatus();
        console.log("success :",msg.responseText);
        ajaxLoading = false;
    },
    error: function(jxhr){
        console.log("error:",{jxhr});

    }
});
