function set_info(name,email,filename,bio,hometown){
	$(".member_info_modal").css("display", "block");
	$(".member_info_modal img").attr('src','img/'+filename);
	$("#member_name").text(name);
	$("#member_email").text(email);
	$("#member_bio").text(bio);
	$("#member_hometown").text(hometown);
}

function edit_member(name,email,filename,bio,hometown,member_id,voice_part){
	$(".modal_edit_member").css("display", "block");
	$(".modal_edit_member img").attr('src','img/'+filename);
	$("#edit_name").val(name);
	$("#edit_email").val(email);
	$("#edit_bio").val(bio);
	$("#edit_hometown").val(hometown);
	$("#edit_member_id").val(member_id);
	$("#edit_voice_part").val(voice_part);
}

function delete_image(image_id,filename,description) {
	$(".modal_delete_image").css("display", "block");
	$("#delete_image_id").val(image_id);
	$("#image_tobe_deleted").attr('src','img/'+filename);
	$("#delete_description").text(description);
}

$(document).ready( function () {
	
	$("#about_dropdown").hover( 
		function() {
			$(".dropdown").css("display", "block");
		},
		function() {
			$(".dropdown").css("display", "none");
	});
	
	//hide the modal if click on the red X
	$(".exit").on("click", function (){
		$(".modal").css("display", "none");
	});

	//display the add member form
	$(".add_member_button").on("click", function (){
		$(".modal_add_member").css("display", "block");
	});

	//display the add image form
	$(".add_image_button").on("click", function (){
	 	$(".modal_add_image").css("display", "block");
	});

	//cancel deleting image from gallery
	$(".cancel_delete_button").on("click", function (){
		$(".modal").css("display", "none");
	});

	//hide the modal if submit button is clicked
	$(".submit_edit_button").on("click",function() {
		$(".modal").css("display", "none");
	});

	//delete member button is clicked, ask again
	$("#delete_member_button").on("click",function() {
		$(".confirmation").css("display","block");
	});
    
    //about page dropdown arrow
    
    $("#downarrow").click(function(){
       $('html,body').animate({
           scrollTop: $(".abouttext").offset().top
       }, 'slow'); 
    });
});
