$( document ).ready(function() {
    let tabs = jQuery(".tab_container .tabs"), data = [];
    if( tabs.length > 0 ) jQuery('li a',tabs).each((i,tab)=>{
        let content_id = jQuery(tab).attr('rel')
        content = jQuery(content_id);

        let listen = {
            kanji:  $('ruby',tab).get(0).innerText,
            hira: $('ruby rt',tab).get(0).innerText,
            mp3: $('audio source',content).attr('src'),
            sentences:[]
        };
        
        if( listen.kanji == '練習' ){
            
            jQuery('> table',content).each((i,table)=>{
                let sentence = [];
                let vietnameses = jQuery(table).nextAll('.slide').first().find('.slide-content').clone();
                jQuery('p',vietnameses).first().remove();
                jQuery('tr',table).each((i2,tr)=>{
                    let row = [];
                    jQuery('td',tr).each((i3,td)=>{
                        row.push(td.innerText);
                    });
                    let trans = jQuery('p',vietnameses);
                    if( trans.length <= 3 ){
                        trans = jQuery('table tr',vietnameses);
                    }
                    if( typeof  trans.get(i2) !== 'undefined'){
                        sentence.push({'jp':row,'vi':trans.get(i2).innerText});
                    } else {
                        console.log("debug error ",{trans,i2,row,vietnameses});
                    }
                    

                });
                listen.sentences.push(sentence);
            });
        } else {
            jQuery('.tudich',content).each((i,se)=>{
                let test = jQuery('.candich',se).clone().find('span').replaceWith(function() { return this.innerHTML; }).end();
                let sentence = {
                    'jp' : jQuery('.candich',se).clone().find('span').replaceWith(function() { return this.innerHTML; }).end().html(),
                    'jp_debug' : test.text().replace(/ *\([^)]*\) */g, ""),
                    'vn' : jQuery('.kqdich',se).text()
                };
                listen.sentences.push(sentence);
            });
        }
        data.push(listen);
    });
    console.log(data);
    //console.warn('debug',{tabs});
});