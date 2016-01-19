
$('.feild_find').click(function(){
	window.location.replace( "../gameLibrary/returnGame.php?searchName=" + $(this).find(".game_name").text() + "&" + $(this).find(".game_platform").text() );
});

$(' .search_header ').find("span").click(function(){
	var list = $('.feild_find').get().sort()	
	list.reverse();
	
	$(list).each(function(){
		$('.showTable').append($(this));
	});
	$(this).html((entityForSymbolInContainer($(this)) == "&#x02C4;") ? "&#709;" : "&#708; ");
});

function entityForSymbolInContainer(selector) {
    var code = $(selector).text().charCodeAt(0);
    var codeHex = code.toString(16).toUpperCase();
    while (codeHex.length < 4) {
        codeHex = "0" + codeHex;
    }

    return "&#x" + codeHex + ";";
}