<?php
include_once 'USER_CMS.php';
$userTypeId = 0;
$userTypeName = '';
if(isset($_REQUEST['arg'])){
	$sql="SELECT * FROM authentication_type WHERE idAuthentType='".$_REQUEST['arg']."'";
	$result=mysqli_query($conn,$sql);
	$userType_Obj=fetch_single_object($result);
	$userTypeId = $userType_Obj->idAuthentType;
	$userTypeName = $userType_Obj->aTypeName;
}
$disabled = "";
if(isset($_REQUEST['view'])){
	$disabled = "disabled";
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		//toupperchange();  
		$("#userAddEdit").validate({
			rules: {
				typeName: {
					noSpace: true,
					required:true
				}
			},
			messages: {
				typeName: "Please enter user type",
			}
		});
	});
	function saveUserType(typeVal){
		if ($('#userAddEdit').valid()) {
			disableSave();
			$.ajax({
				url : 'Users/USER_INTER.php?request=userTypeInsertUpdate',
				data : $("#userAddEdit").serialize(),
				type : 'post',
				success : function(data){
					if(data.trim()=='false'){
						jAlert(" User type already exists");
						enableSave();
					}else{
						jAlert("Saved successfully","S");
						loadData('Users/userTypeList.php');
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
	<h4 class="modal-title" id="myModalLabel">User type
		<?php if(isset($_REQUEST['view'])){ echo 'view'; }else if(isset($_REQUEST['arg'])){ echo 'edit'; }else{ echo 'add'; }?> </h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-lg-12">
				<form role="form" id="userAddEdit">
					<input type="hidden" value="<?php echo $userTypeId; ?>" name="typeId" id="typeId">
					<div class="form-group">
						<label>User type<?php if(!isset($_REQUEST['view'])){?><span class="valid">*</span><?php }?></label> 
						<input autocomplete="off" type="text" class="form-control" maxlength="50" name="typeName" id="typeName" value="<?php echo $userTypeName; ?>" <?php echo $disabled; ?>>
					</div>
					<div class="form-group">
						<label>Status</label>  
						<div class="radio">
							<label style="cursor: default;"> 
								<input autocomplete="off" type="radio" name="uT_Status" id="uT_Status" value="1" checked <?php echo $disabled; ?>>Active
							</label>&nbsp;&nbsp;
							<label style="cursor: default;"> 
								<input autocomplete="off" type="radio" name="uT_Status" id="uT_Status" value="2" <?php if($userStatus==2){ echo 'checked'; } ?> <?php echo $disabled; ?>>Inactive
							</label>
						</div>
					</div>
					<input type="reset" id="rstBtn" style="display: none;">
				</form>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<?php if(!isset($_REQUEST['view'])){ ?>
		<button type="button" class="btn btn-info" onclick="saveUserType(1);">Save</button>
		<?php } ?>
		<?php if(!isset($_REQUEST['arg'])){ ?>
		<button type="button" class="btn btn-success" onclick="saveUserType(2);">Save &amp; Continue</button>
		<?php } ?>
		<button type="button" class="btn btn-default" onclick="clearPopup();" data-dismiss="modal">Close</button>
	</div>