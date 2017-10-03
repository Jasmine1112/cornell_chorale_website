$(document).ready( function () {

	//Initialize the request variable to null
	request = null;
	
	$("#search_member_input").on("keyup", function(){
		var request = $.ajax({
			type: 'GET',
			url: "ajax_sql.php",
			dataType: 'json'
		});
		
		request.done(displayFiltered);
	});

	function displayFiltered(data){
		//see if the administrator logged in
		if ($("#session").val()!=""){
			var session = true;
		}else{
			var session = false;
		}
		$search_input = $("#search_member_input").val();

		var search_input=$search_input;
		var sopranos_displayed= [];
		var altos_displayed= [];
		var tenors_displayed= [];
		var basses_displayed= [];
		var others_displayed= [];

		for(var i = 0; i < data.length; i++){
			var rowi_name = data[i]["name"];
			var rowi_email = data[i]["email"];
			if (rowi_email==null) {
				rowi_email="";
			}

			//if search name input is empty, then all member name count
			if (search_input=="") {
				if (data[i]["voice_part"] == "Sopranos") {
					sopranos_displayed.push(data[i])
				}else if (data[i]["voice_part"] == "Altos") {
					altos_displayed.push(data[i])
				}else if (data[i]["voice_part"] == "Tenors") {
					tenors_displayed.push(data[i])
				}else if (data[i]["voice_part"] == "Basses") {
					basses_displayed.push(data[i])
				}else{
					others_displayed.push(data[i])
				}
			}else{//if search field has an input
				//if the name or email matches search input
				if ((rowi_name.toLowerCase()).includes(search_input.toLowerCase())
					|| (rowi_email.toLowerCase()).includes(search_input.toLowerCase())) {
					
					if (data[i]["voice_part"] == "Sopranos") {
						sopranos_displayed.push(data[i])
					}else if (data[i]["voice_part"] == "Altos") {
						altos_displayed.push(data[i])
					}else if (data[i]["voice_part"] == "Tenors") {
						tenors_displayed.push(data[i])
					}else if (data[i]["voice_part"] == "Basses") {
						basses_displayed.push(data[i])
					}else{
						others_displayed.push(data[i])
					}
				}
			}

		}//end of for loop

		//display member cells
		var parts_displayed = [sopranos_displayed,altos_displayed,tenors_displayed,basses_displayed,others_displayed];
		var parts = ["Sopranos","Altos","Tenors","Basses","Others"];
		var member_cells = ['','','','',''];
		for (var j = 0; j < parts.length; j++) {
			member_cells[j]=member_cells[j]+'<div class="voice_part">'+'<h3>'+parts[j]+'</h3>';
			for (var k = 0; k < parts_displayed[j].length; k++) {

				var memberi_name=parts_displayed[j][k]["name"];
				var memberi_email=parts_displayed[j][k]["email"];
				var memberi_bio=parts_displayed[j][k]["bio"];
				var memberi_hometown=parts_displayed[j][k]["hometown"];
				var memberi_filename=parts_displayed[j][k]["filename"];
				var memberi_member_id=parts_displayed[j][k]["member_id"];

				if (memberi_email==null) {
					memberi_email="";
				}
				if (memberi_bio==null) {
					memberi_bio="";
				}

				/* memberi_name = memberi_name.replace("'","\\'");
				memberi_name = memberi_name.replace('"','\\"');

				memberi_email = memberi_email.replace("'","\\'");
				memberi_email = memberi_email.replace('"','\\"');

				memberi_filename = memberi_filename.replace("'","\\'");
				memberi_filename = memberi_filename.replace('"','\\"');

				memberi_bio = memberi_bio.replace("'","\\'");
				memberi_bio = memberi_bio.replace('"','\\"');

				memberi_hometown = memberi_hometown.replace("'","\'");
				memberi_hometown = memberi_hometown.replace('"','\"'); */

				member_cells[j]+='<div class="member_cell">';
				member_cells[j]+='<img src="img/'+memberi_filename+'" alt="'+memberi_name+'" onClick="set_info(\''+memberi_name+'\',\''+memberi_email+'\',\''+memberi_filename+'\',\''+memberi_bio+'\',\''+memberi_hometown+'\')">';
				member_cells[j]+='<div class="member_info">';
				member_cells[j]+='<span>'+memberi_name+'</span>';
				member_cells[j]+='</div><!-- end member_info div -->';
				if (session) {
					member_cells[j]+='<span class=\"button\" onClick=\"edit_member(\''+memberi_name+'\',\''+memberi_email+'\',\''+memberi_filename+'\',\''+memberi_bio+'\',\''+memberi_hometown+'\',\''+memberi_member_id+'\',\''+parts[j]+'\')\">Edit</span>';
				}			
				member_cells[j]+='</div><!-- end member_cell div -->';
			}
			member_cells[j]=member_cells[j]+'</div><!--end voice part div-->'
		}

		$("#memberscontent").html(member_cells.join(" "));
	}

});