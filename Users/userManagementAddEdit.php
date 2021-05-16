<?php
include_once 'USER_CMS.php';
$userId = 0;
$access_User='';
$Name = '';
$userType='';
//$Type='';
//$TypeId='';
$userName = '';
$password = '';
$userStatus = 1;
if (isset ( $_REQUEST ['arg'] )) {
	$sql="SELECT * FROM authentication WHERE idAuthent='".$_REQUEST['arg']."'";
	$result=mysqli_query($conn,$sql);
	$user_Obj=fetch_single_object($result);
	$userId = $user_Obj->idAuthent;
	$deptId=$user_Obj->a_dept_id;
	$idNo = $user_Obj->a_IdNumber;
	$EmailId = $user_Obj->a_Email;
	$Mobile = $user_Obj->a_mobile;
	$Name = $user_Obj->aName;
	$userType=$user_Obj->a_idAuthentType;
	//$Type = $user_Obj->a_idAuthentType;
	$userName = $user_Obj->aLogName;
	$password = decrypt_pass($user_Obj->aLogPass);
	$userStatus = $user_Obj->aLogStatus;
	 
}

$disabled = "";
if (isset ( $_REQUEST ['view'] )) {
	$disabled = "disabled";
}

?>
<script type="text/javascript">

$(document).ready(function(){
	 //toupperchange();  
	
	$("#userAddEdit").validate({
		rules: {
			aName: {
			          noSpace: true,
			          required:true
      				},
      		aLogName: {
			          noSpace: true,
			          required:true
      				},
      		aLogPass: {
			          noSpace: true,
			          required:true
      				},
      		id_num: {
			          noSpace: true,
			          required:true
      				},
      		contact_num: {
			          noSpace: true,
			          required:true,
			          number:true,
					  minlength:10,
      				},
			aTypeName: "required",
			department: "required"
		},
		messages: {
			aTypeName: "Please choose user type",
			aName: "Please enter user name",
			aLogName: "Please enter login name",
			aLogPass: "Please enter password",
			department: "Please choose department",
			id_num: "Please enter id number",
			contact_num: "Please enter valid contact number",
		}
	});

});
	function saveUser(typeVal){
		 if ($('#userAddEdit').valid()) {
		 	disableSave();
		//if(o_obj.notNull($("#aTypeName").val(), "#aTypeName", "Please select user type") == false){return false;}
		//if(o_obj.notNull($("#aName").val(), "#aName", "Please enter name") == false){return false;}
		//if(o_obj.notNull($("#aLogName").val(), "#aLogName", "Please enter user name") == false){return false;}
		//if(o_obj.notNull($("#aLogPass").val(), "#aLogPass", "Please enter password") == false){return false;}
		
		$.ajax({
			url : 'Users/USER_INTER.php?request=userInsertUpdate',
			data : $("#userAddEdit").serialize(),
			type : 'post',
			success : function(data){
				if(data.trim()=='false'){
					jAlert(" Username already exists");
				}else{
					jAlert("User added successfully","S");
					loadData('Users/userManagementList.php');
					$("#rstBtn").trigger('click');
					if(typeVal==1){
						$("#closeClick").trigger('click');
					}
					else if(typeVal==2){
						enableSave();
					}
				}
			}
		});	
	}
}
</script>
<div class="modal-header">
	<button type="button" id="closeClick" class="close" onclick="clearPopup();" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title" id="myModalLabel">Users
<?php if(isset($_REQUEST['view'])){ echo 'view'; }else if(isset($_REQUEST['arg'])){ echo 'edit'; }else{ echo 'add'; }?> </h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-lg-12">
			<form role="form" id="userAddEdit">
				<input type="hidden" value="<?php echo $userId; ?>" name="idAuthent" id="idAuthent">
				<div class="col-lg-12" style="margin-top:10px;">
					<div class="col-lg-4">
						<label>User type<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						<select class="form-control" name="aTypeName" id="aTypeName" <?php echo $disabled; ?>>
							<?php drop_down('authentication_type','aTypeName', 'idAuthentType',array('idAuthentType is not null'),$userType,'Y','aTypeName');?>
						</select>
					</div>
					<div class="col-lg-4">
						<label>Department<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						<select class="form-control" name="department" id="department" <?php echo $disabled; ?>>
							<?php drop_down('department','dept_Name', 'dept_Id',array('dept_Status=1'),$deptId,'Y','dept_Name');?>
						</select>
					</div>
					<div class="col-lg-4">
						<label>Id No<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						 <input type="text" autocomplete="off"  class="form-control" name="id_num" id="id_num" value="<?php echo $idNo; ?>"
							<?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-lg-12" style="margin-top:10px;">
					<div class="col-lg-4">
						<label>Email Id<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						 <input type="email" autocomplete="off"  class="form-control" name="email_id" id="email_id" value="<?php echo $EmailId; ?>"
							<?php echo $disabled; ?>>
					</div>
					<div class="col-lg-4">
						<label>Contact No<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						 <input type="text" autocomplete="off"  class="form-control" name="contact_num" id="contact_num" value="<?php echo $Mobile; ?>"
							<?php echo $disabled; ?>>
					</div>
					<div class="col-lg-4">
						<label>User name<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						 <input type="text" autocomplete="off"  class="form-control" name="aName" id="aName" value="<?php echo $Name; ?>"
							<?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-lg-12" style="margin-top:10px;">
					<div class="col-lg-4">
						<label>Login name<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						 <input type="text" autocomplete="off"  class="form-control" name="aLogName" id="aLogName" value="<?php echo $userName; ?>"
							<?php echo $disabled; ?>>
					</div>
					<div class="col-lg-4">
						<label>Login password<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						 <input autocomplete="off"  <?php if(!isset($_REQUEST['view']) || !isset($_REQUEST['edit'])){ ?>type="password" <?php }else{ ?> type="text" <?php } ?> class="form-control" name="aLogPass" id="aLogPass" value="<?php echo $password; ?>"
							<?php echo $disabled; ?>>
					</div>
					<div class="col-lg-4">
						<label>Status</label>
						<div class="radio">
							<label style="cursor: default;"><input type="radio" autocomplete="off"  name="aLogStatus" id="aLogStatus" value="1" checked <?php echo $disabled; ?>>Active</label>&nbsp;&nbsp;
							<label style="cursor: default;"><input type="radio" autocomplete="off"  name="aLogStatus" id="aLogStatus" value="2" <?php if($userStatus==2){ echo 'checked'; } ?>
								<?php echo $disabled; ?>>Inactive</label>
						</div>
					</div>
				</div>
				<input type="reset" id="rstBtn" style="display: none;">
			</form>
		</div>
	</div>
</div>
<div class="modal-footer">
	<?php if(!isset($_REQUEST['view'])){ ?>
	<button type="button" class="savebtn btn btn-info" onclick="saveUser(1);">Save</button>
	<?php } ?>
	<?php if(!isset($_REQUEST['arg'])){ ?>
	<button type="button" class="savebtn btn btn-success" onclick="saveUser(2);">Save
		& Continue</button>
	<?php } ?>
	<button type="button" class="btn btn-default" onclick="clearPopup();"
		data-dismiss="modal">Close</button>
</div>
