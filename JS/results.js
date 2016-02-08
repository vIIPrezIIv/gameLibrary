



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

$('.pageOptions').data( "pageChg" , data);

$('.page_at').change(function(){
	var data = $('.pageOptions').data("pageChg");
	data.Page = $(this).val();
	callForPage( data );
});


$('.next').click(function(){
	var data = $('.pageOptions').data("pageChg");
	if(data.Page < data["Number Of Pages"])
		data.Page += 1;
	else	
		data.Page = 1;
	callForPage( data );
});

$('.prev').click(function(){
	var data = $('.pageOptions').data("pageChg");
	if(data.Page > 1)
		data.Page -= 1;
	else	
		data.Page = data["Number Of Pages"];
	callForPage( data );
});


function callForPage( data ){
	$.ajax({
		method: "POST",
		url: "php/retrieveGames.php",
		data: data
	}).done(function( msg ) {
		console.log(msg);
		$('.page_at').text($('.pageOptions').data("pageChg").Page);
		$('.showTable').find(".feild_find").remove();
		$(msg).appendTo('.showTable');
	});
}

$('#platform_typ').change(function(){
	
	$('.pageOptions').data("pageChg")["Search_restrictions"]["Platform"] = $(this).val();
	callForPage( data );
	
	$.ajax({
		method: "POST",
		url: "php/getPageCount.php",
		data: data
	}).done(function( msg ) {
		$('.max_pg').text(msg);
	});
});

