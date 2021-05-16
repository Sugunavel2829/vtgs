<?php
include_once 'USER_CMS.php';
$userId = SESS_ID;
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#userProfileLogin").validate({
			rules: {
				curnt_pass: "required",
				new_pass: {
					required: true,
				//minlength: 10
			},
			conform_pass: {
				required: true,
				//minlength: 10,
				equalTo: "#new_pass"
			},
		},
		messages: {
			curnt_pass: "Please enter current password",
			new_pass: {
				required: "Please enter new password",
			},
			conform_pass: {
				required: "Please enter confirm password",
				equalTo: "Please enter the same password as above"
			},
		}
	});

		
	});
	function userProfile(typeVal){
		if ($('#userProfileLogin').valid()) {
			if(o_obj.notNull($("#curnt_pass").val(), "#curnt_pass", "Please enter current Password") == false){return false;}
			if(o_obj.notNull($("#new_pass").val(), "#new_pass", "Please enter new Password") == false){return false;}
			if(o_obj.notNull($("#conform_pass").val(), "#conform_pass", "Please conform password") == false){return false;}
			var newpass=$("#new_pass").val();
			var confirmpass=$("#conform_pass").val();
			if(newpass!=confirmpass){
				jAlert('Please check new and confirm password','E');
				return false;
			}
			$.ajax({
				url : 'Users/USER_INTER.php?request=userProfileInsertUpdate',
				data : $("#userProfileLogin").serialize(),
				type : 'post',
				success : function(data){
					if(data.trim()=='false'){
						jAlert("Please check the current password");
						enableSave();
					}
					else{
						jAlert("Saved successfully","S");
						loadData('Users/userProfileList.php');
						$("#rstBtn").trigger('click');
						if(typeVal==1){
							$("#closeClick").trigger('click');
						} 
					}
				}
			});
		}
	}

</script>
<div class="modal-header">
	<button type="button" id="closeClick" class="close" onclick="clearPopup();" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title" id="myModalLabel"> Change password </h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-lg-12">
			<form role="form" id="userProfileLogin" name="userProfileLogin">
				<input type="hidden" value="<?php echo $userId; ?>" name="idUser" id="idUser">
				<div class="form-group">
					<label>Current Password</label> 
					<input autocomplete="off" type="password" class="form-control" maxlength="50" name="curnt_pass" id="curnt_pass" value="">
				</div>
				<div class="form-group">
					<label>New Password</label> 
					<input autocomplete="off" type="password" class="form-control" maxlength="50" name="new_pass" id="new_pass" value= "">
				</div>
				<div class="form-group">
					<label>Confirm  Password</label> 
					<input autocomplete="off" type="password" class="form-control" maxlength="50" name="conform_pass" id="conform_pass" value="" >
				</div>
				
				<input type="reset" id="rstBtn" style="display: none;">
			</form>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-info" onclick="userProfile(1);">Change</button>
	<button type="button" class="btn btn-default" onclick="clearPopup();" data-dismiss="modal">Close</button>
</div>