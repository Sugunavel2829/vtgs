<?php

include_once 'USER_CMS.php';
$user = "SELECT * FROM authentication
LEFT JOIN authentication_type ON idAuthentType=a_idAuthentType
where idAuthent= '".SESS_ID."'";
$result=mysqli_query($conn,$user);
$user_Obj = fetch_single_object($result);

$sql = "SELECT privilages AS prev_Obj FROM authentication_privileges WHERE idAuthent = '".SESS_ID."'";
	$res1 = mysqli_query($conn,$sql);
	$result_Obj = fetch_single_object($res1);
	$previlage=unserialize($result_Obj->prev_Obj);
?>
<script>

	function userprofile(){
		loadPopup('Users/userProfileDetails.php');
	}

</script>

<div class="row">
	<!-- Heading name -->
	<div class="col-lg-11">
		<h1 class="page-header" style="margin-top: 60px;">User Profile details</h1>
	</div>
	<!-- Header button -->
	<!-- Data content -->
	<div class="col-lg-12">
		<table class="tableCount table table-bordered table-hover table-striped">
			<thead>
				<tr style="background-color: #ccccb3;">
					<th>#</th>
					<!--<th>Access user</th>
					<th>User type</th>-->
					<th>User name</th>
					<th>Login name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<!--<td><?php echo $user_Obj->a_access_User==1? "Admin": "User"; ?></td>
					<td><?php echo $user_Obj->aTypeName; ?></td>-->
					<td><?php echo $user_Obj->aName; ?></td>
					<td><?php echo $user_Obj->aLogName; ?></td>
					<td>
					    <?php if($previlage['26']== 'Y'){?>
					        <a onclick="userprofile();" style="cursor: pointer;">Change password</a>
					        <?php } ?>
					</td>
				</tr>		
			</tbody>
		</table>
	</div>
</div>