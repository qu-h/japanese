
$(function () {
	//$("#draw").dmak('電車',{'uri':'//'+window.location.hostname+'/svg/kanji/'});
	//$("#draw").dmak('な',{'uri':'//'+window.location.hostname+'/svg/hiragana/'});
	$( ".writing" ).each(function( index ) {
		console.log('//'+window.location.hostname+'/svg/'+$(this).attr('group')+'/');
		$(this).dmak($(this).attr('char'),{'uri':'//'+window.location.hostname+'/svg/'+$(this).attr('group')+'/'});
  
	});

			//$("#draw").dmak('é›»è»�');

	/*
			var dmak = $("#draw");
			dmak.dmak('é›»è»�', {'element': "draw", "uri": "http://kanjivg.tagaini.net/kanjivg/kanji/"});
			$("#sample-btn").find("button").on("click", function (e) {
				e.preventDefault();
				switch ($(this).attr("id")) {
					case 'p':
						dmak.dmak('rewind', 1);
						break;
					case 's':
						dmak.dmak('pause');
						$(this).toggle();
						$("#g").toggle();
						break;
					case 'g':
						dmak.dmak('play');
						$(this).toggle();
						$("#s").toggle();
						break;
					case 'n':
						dmak.dmak('forward', 1);
						break;
					case 'r':
						dmak.dmak('reset');
						break;
				}
			})
			*/
});