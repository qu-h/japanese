let ajaxLoading = false;

$( document ).ajaxStart(function() {
    ajaxLoading = true;
});

Node.prototype.getNodesText = function(tagName) {
    let text = [], that = this, tags = tagName;
    if( typeof tagName === 'object' && tagName.length > 0 ){
        let tagFirst = tags[0].toString(), tagsLeft = tagName.filter(item => item !== tagFirst);
        if( tagsLeft.length > 0 ){
            try {
                let tags = that.getElementsByTagName(tagFirst.toUpperCase());
                if( tags.length > 0 ){
                    for (let tag of tags ) {
                        text.push( tag.getNodesText(tagsLeft) );
                    }
                }
            }
            catch(err) {
                console.log("have error",{that,err});
            }

        } else {
            let nodeTexts = that.getNodesText(tagFirst);
            text = [...text,...nodeTexts];
        }
    } else if ( typeof tagName === 'string') {
        let texts = that.getElementsByTagName(tagName.toUpperCase());
        if( texts.length > 0 ){
            for (var w of texts ) {
                text.push(w.innerText);
            }
        }
    } else {
        console.log("tagname line-42 :",{tagName,that});
    }
    return text;
};

let kanjiChecking = "";
function getKanjiChar(){
	let kanjiDetail = Array.from(document.querySelectorAll(".dekiru-popup-detail"));
	if( kanjiDetail.length > 0 ){
		kanjiDetail = kanjiDetail[0];
		if( kanjiDetail.innerHTML.length > 0 ){
			let data = {
                word : document.querySelectorAll(".dekiru-popup-detail .qqq.japan-font")[0].innerText,
                chinese : document.querySelectorAll(".dekiru-popup-detail .qqe")[0].innerText,
				//svg : document.getElementById("drawkanji").innerHTML,
                vietnamese:null, onyomi:null,kunyomi:null,
				parts:[],remembering:{image:null,text:null}
				//content : document.querySelectorAll(".dekiru-popup-detail .kanji-search-block")[0].innerHTML,
			};

			if( kanjiChecking === data.word ){
				return true;
			} else {
				kanjiChecking = data.word;
			}

			let searchData = Array.from(document.querySelectorAll(".dekiru-popup-detail .kanji-search-block"));
			for (let i = 0; i < searchData.length; i++) {
				let testData = searchData[i];
				let label = testData.getElementsByTagName("LABEL");
				if( label.length > 0 && typeof label[0] !== 'undefined' ){
					label = label[0].innerText.trim();
					label = label.substring(0, label.length - 1);

					let searchValue = testData.getElementsByTagName("P");
					switch(label) {
						case "Bộ phận cấu thàn":
							searchValue = testData.getElementsByTagName("UL");
							if( searchValue.length > 0 ){
								data.parts = searchValue[0].getNodesText(['li','span']);
							}
							break;
						case "Ví dụ":
							searchValue = testData.getElementsByTagName("UL");
							if( searchValue.length > 0 ){
								data.examples = searchValue[0].getNodesText(['li','p']);
							}
							break;
						case "Hình ảnh gợi nhớ":
							let img = testData.getElementsByTagName("IMG");
							if( img.length > 0 ){
								data.remembering.image = img[0].src;
							}
							break;
						case "Onyomi":
							data.onyomi = testData.getNodesText(['a']);
							break;
						case "Kunyomi":
							data.kunyomi = testData.getNodesText(['a']);
							break;
						default:
							if( searchValue.length > 0 ){
								switch(label) {
									case "Ý nghĩa":
										data.vietnamese = searchValue[0].innerHTML;
										break;
									case "Giải thích":
										data.explanation = searchValue[0].innerHTML;
										break;
									case "Trình độ":
										data.level = searchValue[0].innerText; break;
									case "Số nét":
										data.stroke = searchValue[0].innerText;break;
									case "Cách ghi nhớ":
										data.remembering.text = searchValue[0].innerText;
										break;
									default:
										console.log("check data "+i+":",{label,testData});
									break;
								}
							} else {
								//console.log("check data "+i+": value of '"+label+"'' is null",{searchValue,testData});
							}
							break;
					}
				} else {
					console.log("check data "+i+": label null ",{label,searchValue});
				}
				
			}
			data.source = "j-dict.com";
	        $.ajax({data: data});
		}
		
	} else {
		console.log("no see kanjiDetail",{kanjiDetail});
	}
}

const symbols = [];

function getKanjiStatus(){
	let chars = jQuery("#kanji-filter-result .kanji-in-list-item div.img");
	console.log("getKanjiStatus",{chars});
	console.log('debug',symbols);
	chars.map((i,char)=>{
		if( typeof char.dataset.saved === 'undefined' ){
			let symbol = {symbol:char.dataset.text,id:char.id};
			let check = symbols.find(c=>c.id===symbol.id);
			if( typeof check ==='undefined' ){
				symbols.push(symbol);
			}
		}
		
	});
	console.log('debug',symbols);
	$.ajax({
		data: {symbols:symbols},
		type: "POST",
		url: ajaxJDict.uri('kanji/symbols-status'),
		success: function(data){
			if( data instanceof Array ){
				data.map((row)=>{
					if(typeof row.saved !== 'undefined' && row.saved) {
						$("#"+row.id)
							.css({'background':configjDict.color.saved})
							.attr('data-saved',true);
						
						let symbolIndex = symbols.findIndex(s => s.id === row.id);
						console.log(' find symbold id',symbolIndex, row.id);
						//symbols.splice( symbolIndex, 1 );
					}
				});
			} else  if( typeof data === 'object' && data.saved ){
				$(char).css({'background':configjDict.color.saved});
			}
		}
	});
	console.log('finish load ',symbols);
}

$( document ).ready(function() {
	//getKanjiStatus();
	console.log('this on document ready');
    $('#kanji-filter-result .btn-small').click(function(){
    	kanjiChecking = "";
    });
});

let kanjModaliArea = document.querySelectorAll(".dekiru-popup-detail");
Array.from(kanjModaliArea).forEach(function(node) {
	node.addEventListener('DOMNodeInserted', getKanjiChar);
});

