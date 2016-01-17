

$('document').ready(function(){
	$('.editVal').click(function(){
		if(!$(this).parent().find('.edit_Row').length){
			$('<input class="edit_Row" type="text" value="'+ $(this).siblings().text() +'"/>').insertBefore( $(this) ).keypress( function( event ){
				if(event.charCode == 13)
					endEdit($(this));		
			});				
			$(this).parent().find("span").remove();
		}else
			endEdit($(this));
	});
});

function endEdit( el ){
	el.parent().prepend("<span>" + el.parent().find("input:text").val() + "</span>");
	updateEdit(  el.parent().parent().find('.value_lbl').text() , el.parent().find("input:text").val() );
	el.parent().find("input:text").remove();
	
}

function updateEdit( title , val ){
	
	$.ajax({
		method: "POST",
		url: "PHP/updateProfile.php",
		data: { name: title, value: val }
	}).done(function( msg ) {
		console.log( msg );
	});
	
}