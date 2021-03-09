tinymce.init({selector:'textarea'});

$(document).ready(function(){

	$('#selectAllBoxes').click(function(event){

	if(this.checked) {

	$('.checkBoxes').each(function(){

	    this.checked = true;

	});

} else {


	$('.checkBoxes').each(function(){

	    this.checked = false;

	});


	}

	});







	var div_box = "<div class='body'><div class='box_new'><p class='p_new'>l</p><p class='p_new'>o</p><p class='p_new'>a</p><p class='p_new'>d</p><p class='p_new'>i</p><p class='p_new'>n</p><p class='p_new'>g</p></div></div>";

	$("body").prepend(div_box);
	$('.body').delay(500).fadeOut(600, function(){
	   $(this).remove();
	});
	$('.box_new').delay(500).fadeOut(600, function(){
		$(this).remove();
	 });
	 $('.p_new').delay(500).fadeOut(600, function(){
		$(this).remove();
	 });
  


});


function loadUsersOnline() {


	$.get("functions.php?onlineusers=result", function(data){

		$(".useronline").text(data);


	});



}


setInterval(function(){

	loadUsersOnline();


},500);













