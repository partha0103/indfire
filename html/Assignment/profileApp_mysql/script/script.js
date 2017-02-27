"use strict"
var error_element = false;
//$("#submit").attr('disabled', 'disabled');

$(document).ready(function(){
	
	$(document).on('click','.view_posts',function() {
		var user_id = $(this).data('id');
		$.ajax({
			url : "wordpressposts.php",
			type : 'POST',
			data :{
				'id' : user_id
			},
			// dataType : 'json',
			success : function(response){
				var wordpress_posts = '';

				if(!response){
					wordpress_posts="<div class='well'>"+"<p>Don't have wordpress account.create one <a target='_blank' href='https://wordpress.com/start/design-type-with-store'><i class='fa fa-external-link-square' aria-hidden='true'></i></a>"
				}
				else{
					var user_data = JSON.parse(response);
					$('.modal-title').val(user_data.posts[0].author.name);
					for (var i = user_data.posts.length - 1; i >= 0; i--) {
						wordpress_posts+="<div class='well'><h3>"+user_data.posts[i]['title']+"</h3>"
						+user_data.posts[i]['excerpt']+"<a target='_blank'href='"+user_data.posts[i]['URL']+"'><i class='fa fa-external-link-square' aria-hidden='true'></i></a></div>";
					}
				}
				$('#modalid').html(wordpress_posts);
			}
		});
	});

	$(document).on('click','.view_user',function() {
		alert(1);
		var user_id = $(this).data('id');
		$.ajax({
			url : "view.php",
			type : 'POST',
			data :{
				'id' : user_id
			},
			// dataType : 'json',
			success : function(response){
				$(".modal-body").html(response);
				$("#myModal").modal('show')
			}
		});
	});

	$(document).on('click','.delete_user',function(){
		var user_id = $(this).data('id');
		var id = $(this).parent().parent();
		console.log(id);
		$.ajax({
			url : "delete.php",
			type : 'POST',
			data :{
				'id' : user_id
			},
			// dataType : 'json',
			success : function(response){
				// console.log(user_id);
				$(id).remove();
			}
		});
	})
	$().on('click','.edit_user',function(){
		var user_id = $(this).data('id');
		// var id = $(this).parent().parent().attr('id')
		$.ajax({
			url : "update.php",
			type : 'POST',
			data :{
				'id' : user_id
			},
			// dataType : 'json',
			success : function(response){
				$("#modal_form").modal('show');
				var user_data = JSON.parse(response);
				$('#employee_id').val(user_data.id);
				$('#first_name').val(user_data.first_name);
				$('#middle_name').val(user_data.middle_name);
				$('#last_name').val(user_data.last_name);
				$('#company').val(user_data.company);
				$('#position').val(user_data.position);
				$('#present_address').val(user_data.present_add);
				$('#permanent_address').val(user_data.permanent_add);
				$('#present_zip').val(user_data.present_zip);
				$('#permanent_zip').val(user_data.permanent_zip);
				$('#email').val(user_data.email_id);
			}
		});
	})

	$(document).on('submit', '#update_form',function() {
		var form = $("#update_form");
		console.log($("#update_form").serialize());
		$.ajax({
			url: "edit.php",
			type: 'POST',
			data: form.serialize(),
			success : function(response){
				$("#modal_form").modal('hide')
			}
		})
	});
})

function isValidEmail(id) {
	var email = $(id).val();
	var re = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
	if (!(re.test(email))){
		error_element = true;
		if ($(id).next("#email_validation").length == 0) {
			$('#email_field').removeClass('has-success');
			$('#email_field').addClass('has-error');
			$(id).after('<p id="email_validation" class="text-danger">Invalid email id</p>');
		}
	}
	else{
		error_element = false;
		$('#email_field').removeClass('has-error');
		$('#email_field').addClass('has-success');
		$(id).next("#email_validation").remove();	
	}
}

function isValidPassword(id) {
	var password = $(id).val();
	var re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
	if (!(re.test(password))){
		error_element = true;
		if ($(id).next("#password_validation").length == 0) {
			$('#password_field').removeClass('has-success');
			$('#password_field').addClass('has-error');
			$(id).after('<p id="password_validation" class="text-danger">Invalid password</p>');
		}
	}
	else{
		$('#password_field').removeClass('has-error');
		$('#password_field').addClass('has-success');
		error_element = false;
		$(id).next("#password_validation").remove();	
	}
}

function isvalidZip(id) {
	var zip = $(id).val();
	var regex = /^\d{6}$/ ;
	if (!(regex.test(zip))){
		error_element = true;
		if ($(id).next("#zip_validation").length == 0) {
			$('#zip_field').removeClass('has-success');
			$('#zip_field').addClass('has-error');
			$(id).after('<p id="zip_validation" class="text-danger">Invalid Zip</p>');
		}
	}
	else{
		$('#zip_field').removeClass('has-error');
		$('#zip_field').addClass('has-success');
		error_element = false;
		$(id).next("#zip_validation").remove();	
	}
}

function isValidName(id1 , id2) {
	var name = $(id1).val();
	var regex =  /^[A-Za-z]+$/ ;
	if (!(regex.test(name))){
		error_element = true;

		if ($(id1).next("#validation").length == 0) {
			$(id2).removeClass('has-success');
			$(id2).addClass('has-error');
			$(id1).after('<p id="validation" class="text-danger">Enter a valid name</p>');
		}
	}
	else{
		$(id2).removeClass('has-error');
		$(id2).addClass('has-success');
		error_element = false;
		$(id1).next("#validation").remove();	
	}
}

function isValidMobileNo(id) {
	var mobile_no = $(id).val();
	var regex = /^\d{10}$/ ;
	if (!(regex.test(mobile_no))){
		error_element = true;

		if ($(id).next("#mobile_validation").length == 0) {
			$('#phone_no_field').removeClass('has-success');
			$('#phone_no_field').addClass('has-error');
			$(id).after('<p id="mobile_validation" class="text-danger">Invalid mobile No. The phone no must contain 10 numbers</p>');
		}
	}
	else{
		$('#phone_no_field').removeClass('has-error');
		$('#phone_no_field').addClass('has-success');
		error_element = false;
		$(id).next("#mobile_validation").remove();	
	}
}

function isPasswordMatch(){
    var input1 = $("#confirm_password").val();
    var input2 = $("#password").val();
    if (input1 != input2){
    	error_element = true;
		if ($("#confirm_password").next("#confirmPassword").length == 0) {
			$('#confirm_password_field').removeClass('has-success');
			$('#confirm_password_field').addClass('has-error');
			$("#confirm_password").after('<p id="confirmPassword" class="text-danger">Password not matched</p>');
		}
	}
	else{
		$('#confirm_password_field').removeClass('has-error');
		$('#confirm_password_field').addClass('has-success');
		$("#confirm_password").next("#confirmPassword").remove();	
	}
}

//Date of birth validation
function isValidDateOfBirth(id1) {
    var date = $(id1).val().split("-");
    var year = date[0];
    var month = date[1];
    var day = date[2];
    var today = new Date();
    if ((today.getFullYear() - year) >= 18) {
        error_element = false;
       	$(id1).next("#validDOB").remove(); 
    }
    else{
    	if ($(id1).next('#validDOB').length == 0){
        	$(id1).after('<p id="validDOB" class="text-danger">The candidate must be 18 years or older</p>');
        }
        error_element = true; 
    }
}

//inputfield validation
$(document).ready(function(){
	$('form').on('submit',function(e){
		var inputArray = $('input');
		var inputfield = false;
		for (var i = 0; i < inputArray.length; i++) {
			if (inputArray[i].value == "" ) {
				inputfield = true;
				}
		}
		if (inputfield || error_element) {
			e.preventDefault();
			return false;
		}
		else
			return true;
	});
})


