<?php
include_once 'USER_CMS.php';
/*$prev_Obj = get_table_object('authentication_privileges', array('idAuthent = '.SESS_ID));
$privilage=unserialize($prev_Obj->privilages);*/
$sql = "SELECT privilages AS prev_Obj FROM authentication_privileges WHERE idAuthent = '".SESS_ID."'";
	
	$res1 = mysqli_query($conn,$sql);
	$result_Obj = fetch_single_object($res1);
	$privilage=unserialize($result_Obj->prev_Obj);
?>
<script>
    $(document).ready(function(){
    	//toupperchange();
    	$('#dataTabl').DataTable({
            lengthMenu: [[20, 40, 60, -1], [20, 40, 60, "All"]]
        });
    });
	function actionButton(tVal, autoId){
		if(tVal==2){
			loadPopup('Users/userTypeAddEdit.php?arg='+autoId);
		}else if(tVal==3){
			loadPopup('Users/userTypeAddEdit.php?arg='+autoId+'&view');
		}
	}
</script>
<div class="row">
	<!-- Heading name -->
	<div class="col-lg-11">
		<h1 class="page-header" style="margin-top: 60px;">User type details</h1>
	</div>
	<!-- Header button -->
	<div class="col-lg-1">
		<?php if($privilage['17'] == 'Y'){ ?>
		<button type="button" style="margin-top: 60px;" class="btn btn-primary pull-right btn-sm btn-flat" onclick="loadPopup('Users/userTypeAddEdit.php');"><i class="fa fa-plus"> &nbsp;</i>Add New</button>
		<?php } ?>
	</div>
	<!-- Data content -->
	<div class="col-lg-12">
		 <table class="table table-striped table-bordered dt-responsive nowrap" id="dataTabl" width="100%" cellspacing="0">
          <thead>
            <tr style="background-color: #ccccb3;">   
            	<th>S.No</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
          </thead>
          
           <tbody>
              <?php
              	$query="SELECT aTypeName,aT_Status,idAuthentType FROM authentication_type GROUP BY aTypeName ORDER BY aTypeName ASC ";
    			$data=mysqli_query($conn,$query);
               
    			$i=1;
                foreach($data as $key => $value)   
                {
                	echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$value["aTypeName"].'</td>';
                    if($value["aT_Status"]=='1'){
                        $img='../assets/images/active.png';
                    }else{
                        $img='../assets/images/inactive.png';
                    }  
                ?>
                <td align="center"><img style="width: 15px;" src="<?php echo $img;?>"></td>
                <td style="text-align: center;">
                	<?php if($privilage['18']== 'Y'){?>
                        <a data-id="107" onclick='actionButton(2,<?php echo $value["idAuthentType"]?>);'><i class="fa fa-edit"></i> </a>&nbsp;
                     <?php } ?>
                    <?php if($privilage['19']== 'Y'){?>
                        <a data-id="107" onclick='actionButton(3,<?php echo $value["idAuthentType"]?>);'><i class="fa fa-eye"></i> </a>&nbsp;
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