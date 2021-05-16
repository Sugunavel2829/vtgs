<?php
include_once 'USER_CMS.php'; 

    global $conn;

    $sql = "SELECT privilages AS prev_Obj FROM authentication_privileges WHERE idAuthent = '".SESS_ID."'";
    
    $res1 = mysqli_query($conn,$sql);
    $result_Obj = fetch_single_object($res1);
    $privilage=unserialize($result_Obj->prev_Obj);
    
    
    $authUser="SELECT a_idAuthentType,a_access_User FROM authentication WHERE idAuthent = '".SESS_ID."' ";
    $res = mysqli_query($conn,$authUser);
	$authUser_Obj = fetch_single_object($res);
	$userType=$authUser_Obj->a_idAuthentType;
	$condition="";
	if($userType != '1'){
		$condition=" WHERE idAuthent ='".SESS_ID."'";
		//echo 
	}
?>
<script>
	$(document).ready(function(){
		$('#dataTabl').DataTable({
		    lengthMenu: [[20, 40, 60, -1], [20, 40, 60, "All"]]
        });
	});
	function actionButton(tVal, autoId){
		if(tVal==1){
			loadPopup('Users/userManagementAddEdit.php?arg='+autoId,1000);
		}else if(tVal==2){
			loadPopup('Users/userManagementAddEdit.php?arg='+autoId+'&view',1000);
		}else if(tVal==3){
			loadData('Users/userPrivilegsList.php?arg='+autoId+'&view');
		}
	}
</script>
<div class="row">
	<!-- Heading name -->
	<div class="col-lg-11">
		<h1 class="page-header" style="margin-top: 60px;">Application users details</h1>
	</div>
	<!-- Header button -->
	<div class="col-lg-1">
		<?php if($privilage['21'] == 'Y'){  ?>
		<button type="button" style="margin-top: 60px;" class="btn btn-primary pull-right  btn-sm btn-flat" onclick="loadPopup('Users/userManagementAddEdit.php',1000);"><i class="fa fa-plus"> &nbsp;</i>Add New</button>
		<?php }?>

	</div>
	<!-- Data content -->
	<div class="col-lg-12">
		  <table class="table table-striped table-bordered dt-responsive nowrap" id="dataTabl" width="100%" cellspacing="0">
            <thead>
                <tr style="background-color: #ccccb3;">   
                	<th>S.No</th>
                	<!-- <th>Access user</th> -->
                	<th>User Type</th>
                	<th>User Name</th>
                	<th>Login Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              	$query="SELECT * FROM authentication
		              	LEFT JOIN authentication_type ON idAuthentType = a_idAuthentType $condition ORDER BY aTypeName,aName ASC ";
    			$data=mysqli_query($conn,$query);
    			$i=1;
                foreach($data as $key => $value)   
                {
                    echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$value["aTypeName"].'</td>
                    <td>'.$value["aName"].'</td>
                    <td>'.$value["aLogName"].'</td>';
                    if($value["aLogStatus"]=='1'){
                        $img='../assets/images/active.png';
                    }else{
                        $img='../assets/images/inactive.png';
                    }  
                ?>
                <td align="center"><img style="width: 15px;"  src="<?php echo $img;?>"></td>
                <td style="text-align: center;">
                	<?php if($privilage['22'] == 'Y'){ ?>
                        <a data-id="107" onclick='actionButton(1,<?php echo $value["idAuthent"] ?> );'><i class="fa fa-edit"></i> </a>&nbsp;
                    <?php } ?>
                    <?php if($privilage['23'] == 'Y'){ ?>
                        <a data-id="107" onclick='actionButton(2,<?php echo $value["idAuthent"] ?>);'><i class="fa fa-eye"></i> </a>&nbsp;
                	<?php } ?>
                    <?php if($privilage['24'] == 'Y'){ ?>
                        <a data-id="107" onclick='actionButton(3,<?php echo $value["idAuthent"] ?>);'><i class="fa fa-lock"></i> </a>&nbsp;
                    <?php } ?>
                </div>
                </td>
                </tr>
                <?php 
                   $i=$i+1;
                }
                ?>      
            </tbody>
        </table> 
	</div>
</div> 
