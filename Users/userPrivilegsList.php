<?php
include_once 'USER_CMS.php';
/*$Name = table_value ( 'authentication', 'aName', array ('idAuthent = ' . $_REQUEST ['arg'] ) );
$cond = array();
$cond[] = 'idAuthent = '.$_REQUEST['arg'];
$prev_Obj = get_table_object('authentication_privileges', $cond);
$privilage=unserialize($prev_Obj->privilages);
*/
$sql = "SELECT aName AS aName FROM authentication WHERE idAuthent = '".$_REQUEST ['arg']."'";
$result = mysqli_query($conn,$sql);
$result_Obj = fetch_single_object($result);
$Name=$result_Obj->aName;

$sql1 = "SELECT privilages AS prev_Obj FROM authentication_privileges WHERE idAuthent = '".$_REQUEST ['arg']."'";

$result1 = mysqli_query($conn,$sql1);
$result_Obj = fetch_single_object($result1);
$privilage=unserialize($result_Obj->prev_Obj);

?>
<script type="text/javascript">
    function savePrivilage(){
        $.ajax({
            url : 'Users/USER_INTER.php?request=privilageInsertUpdate',
            data : $("#userprivilegeAddEdit").serialize(),
            type : 'post',
            success : function(data){
                jAlert("Privilege added successfully","S");
                loadData('Users/userManagementList.php');
            }
        });
    }

    function check_enable(e, valArr){
        // if(e){

        //     for(var i = 0; i<valArr.length; i++){
        //         $('input[type=checkbox][value='+valArr[i]+']').prop('disabled', false);
        //     }
        
        // }else{

        //     for(var i = 0; i<valArr.length; i++){
        //         //alert(i);
        //         // $('input[type=checkbox][value='+valArr[i]+']').prop('checked', false);   
        //         $('input[type=checkbox][value='+valArr[i]+']').prop('disabled', true);

        
        //     }
        
        // }
    }
    function togglehide(id){
     if($("."+id).is(":visible")){
        $("."+id).hide();
    }
    else{
        $("."+id).show();
    }

}

function trigger_main(){
   $('.main').each(function(){
    var evt = $(this).attr('onclick');
    eval(evt);
});
   
}
$(document).ready(function(){
    trigger_main();
});

</script>
<?php
/*$dashboardArr=array('disabled'=>array('72','73','74','75'),'thisval'=>'71','name'=>'Dashboard',
    'additional'=>array(
        array('name'=>'Total Tickets','thisval'=>'72'),
        
        array('name'=>'Pending Tickets','thisval'=>'73'),
        
        array('name'=>'Processing Tickets','thisval'=>'74'),
        
        array('name'=>'Closed Tickets','thisval'=>'75'),
        
        array('name'=>'Pie Chart','thisval'=>'76'),
        
        array('name'=>'Bar Chart','thisval'=>'77'),
        )
    );*/
    $dashboardArr=array('disabled'=>array('72','73','74','75'),'thisval'=>'71','name'=>'Dashboard',
    'additional'=>array(
        array('disabled'=>array('78'),'name'=>'Total Tickets','thisval'=>'72','sub'=>array(array('name'=>'View','thisval'=>'78'))),
        
        array('disabled'=>array('79'),'name'=>'Pending Tickets','thisval'=>'73','sub'=>array(array('name'=>'View','thisval'=>'79'))),
       
        array('disabled'=>array('80'),'name'=>'Processing Tickets','thisval'=>'74','sub'=>array(array('name'=>'View','thisval'=>'80'))),
        
        array('disabled'=>array('81'),'name'=>'Closed Tickets','thisval'=>'75','sub'=>array(array('name'=>'View','thisval'=>'81'))),
        
        array('name'=>'Pie Chart','thisval'=>'76'),
        
        array('name'=>'Bar Chart','thisval'=>'77'),
        )
    );
    
    
$masterArr=array('disabled'=>array('3','7','11'),'thisval'=>'2','name'=>'General Master',
    'additional'=>array(
        array('disabled'=>array('4','5','6'),'name'=>'Institution','thisval'=>'3','sub'=>array(array('name'=>'Add','thisval'=>'4'),array('name'=>'Edit','thisval'=>'5'),array('name'=>'View','thisval'=>'6'))),

        array('disabled'=>array('8','9','10'),'name'=>'Category','thisval'=>'7','sub'=>array(array('name'=>'Add','thisval'=>'8'),array('name'=>'Edit','thisval'=>'9'),array('name'=>'View','thisval'=>'10'))),

        array('disabled'=>array('12','13','14'),'name'=>'Department','thisval'=>'11','sub'=>array(array('name'=>'Add','thisval'=>'12'),array('name'=>'Edit','thisval'=>'13'),array('name'=>'View','thisval'=>'14')))
        )
    );


$usersArr=array('disabled'=>array('16','20','25'),'thisval'=>'15','name'=>'Users',
    'additional'=>array(
        array('disabled'=>array('17','18','19'),'name'=>'User Type','thisval'=>'16','sub'=>array(array('name'=>'Add','thisval'=>'17'),array('name'=>'Edit','thisval'=>'18'),array('name'=>'View','thisval'=>'19'))),

        array('disabled'=>array('21','22','23','24'),'name'=>'Application users','thisval'=>'20','sub'=>array(array('name'=>'Add','thisval'=>'21'),array('name'=>'Edit','thisval'=>'22'),array('name'=>'View','thisval'=>'23'),array('name'=>'Privilege','thisval'=>'24'))),
        
        array('disabled'=>array('26'),'name'=>'Change Password','thisval'=>'25','sub'=>array(array('name'=>'Change Password','thisval'=>'26')))
        )
    );

$ticketDetArr=array('disabled'=>array('32','35','11'),'thisval'=>'31','name'=>'Ticket Details',
    'additional'=>array(
        array('disabled'=>array('33','34'),'name'=>'Raise a Ticket','thisval'=>'32','sub'=>array(array('name'=>'Add','thisval'=>'33'),array('name'=>'View','thisval'=>'34'))),

        array('disabled'=>array('36'),'name'=>'Ticket History','thisval'=>'35','sub'=>array(array('name'=>'View','thisval'=>'36')))
        )
    );

$manageComplientArr=array('disabled'=>array('47','49','51','53','56'),'thisval'=>'46','name'=>'Manage Complaint',
    'additional'=>array(
        array('disabled'=>array('48','55'),'name'=>'Pending Tickets','thisval'=>'47','sub'=>array(array('name'=>'View','thisval'=>'48'),array('name'=>'Cancel','thisval'=>'55'))),

        array('disabled'=>array('50'),'name'=>'Process Tickets','thisval'=>'49','sub'=>array(array('name'=>'View','thisval'=>'50'))),

        array('disabled'=>array('52'),'name'=>'Closed Tickets','thisval'=>'51','sub'=>array(array('name'=>'View','thisval'=>'52'))),
        
        array('disabled'=>array('54'),'name'=>'Mail Information','thisval'=>'53','sub'=>array(array('name'=>'View','thisval'=>'54'))),
        
        array('disabled'=>array('54'),'name'=>'Cancelled Tickets','thisval'=>'56','sub'=>array(array('name'=>'View','thisval'=>'57')))
        )
    );

$reportsArr=array('disabled'=>array('62','64'),'thisval'=>'61','name'=>'Reports',
    'additional'=>array(
        array('disabled'=>array('63'),'name'=>'Ticket Allocated Reports','thisval'=>'62','sub'=>array(array('name'=>'View','thisval'=>'63'))),

        array('disabled'=>array('65'),'name'=>'Tickets Closed Reports','thisval'=>'64','sub'=>array(array('name'=>'View','thisval'=>'65'))),
        )
    );

    
$priArr=array(
    'Dashboard'=>array('thisval'=>'504','additional'=>array($dashboardArr,),'disabled'=>array('80')),
    
    'Masters'=>array('thisval'=>'500','additional'=>array($masterArr,$usersArr,),'disabled'=>array('30')),

    'Ticket Details'=>array('thisval'=>'501','additional'=>array($ticketDetArr),'disabled'=>array('45')),

    'Manage Complients'=>array('thisval'=>'502','additional'=>array($manageComplientArr),'disabled'=>array('60')),

    'Reports'=>array('thisval'=>'503','additional'=>array($reportsArr),'disabled'=>array('70'))
    /*,

    'Pharmacy'=>array('thisval'=>'506','additional'=>array($PharmacyArr),'disabled'=>array('339')),

    'Investigation'=>array('thisval'=>'507','additional'=>array($invistigationArr),'disabled'=>array('385')),

    'Lab Stores'=>array('thisval'=>'508','additional'=>array($LabstoresArr),'disabled'=>array('399')),

    'General Stores'=>array('thisval'=>'509','additional'=>array($GeneralstoresArr),'disabled'=>array('409')),
    'Settings'=>array('thisval'=>'510','additional'=>array($settingArr),'disabled'=>array('421')),

    'Reports'=>array('thisval'=>'511','additional'=>array($reportArr),'disabled'=>array('424'))*/,
    );


//$getUsertype=fetch_single_object("select idAuthent,a_access_User,a_idAuthentType from authentication where idAuthent='".SESS_ID."'");
$getUsertype="select idAuthent,a_access_User,a_idAuthentType from authentication where idAuthent='".SESS_ID."'";
$getUTres = mysqli_query($conn,$getUsertype);
$UTresultset = fetch_single_object($getUTres);
    

$grantArr['1']=array('Masters'=>true,'Ticket Details'=>true,'Manage Complients'=>true,'Dashboard'=>true,'In-Patient'=>true,'Prescription'=>true,'Pharmacy'=>true,'Investigation'=>true,'Lab Stores'=>true,'General Stores'=>true,'Settings'=>true,'Reports'=>true);
$grantArr['2']=array('Ticket Details'=>true,'Ticket Details'=>true);
$grantArr['3']=array('Dashboard'=>true);
$grantArr['4']=array('General Stores'=>true);
$grantArr['5']=array('Lab Stores'=>true);
$grantArr['6']=array('Pharmacy'=>true);
$grantArr['7']=array('Registration'=>true);
$grantArr['8']=array('Settings'=>true);
$grantArr['9']=array('Reports'=>true);

if($UTresultset->a_access_User!='1'){
    unset($priArr);
}
else{
    $var=$UTresultset->a_idAuthentType;
    $accessArr=$grantArr[$var];
}
?>  
<style>
    fieldset.scheduler-border {
        border: 1px groove #00a1ff !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>
<form role="form" id="userprivilegeAddEdit">
    <input type="hidden" value="<?php echo $_REQUEST ['arg']; ?>"
    name="idAuthent" id="idAuthent">
    <div class="row">
        <div>
            <h4 class="page-header" style="margin-top: 60px;"><labl style="color:#660000;font-weight:bold;"><?php echo ucfirst($Name); ?></labl>'s Privilege list</h4>
        </div>
    </div>
    <?php
    if($priArr){
        foreach ($priArr as $key => $value) {
            if($accessArr[$key]){
                ?>
                <fieldset class="scheduler-border">
                   <legend class="scheduler-border">
                    <i class="fa fa-plus" aria-hidden="true" style="cursor: pointer;" onclick="togglehide(<?php echo $value['thisval']; ?>)"></i>
                    <label class="checkbox-inline" style="font-weight: bold;"> <input
                        class="main" type="checkbox" value="<?php echo $value['thisval']; ?>" name="prev[]"
                        <?php if($privilage[$value['thisval']] == 'Y'){ echo 'checked'; } ?>
                        onclick='check_enable(this.checked,[<?php echo implode(",",$value['disabled']);?>]);'> &nbsp;&nbsp; <?php echo $key; ?> 
                    </label>
                </legend>
                <?php 
                foreach ($value['additional'] as $k => $v) {
                    ?>
                    <div class="panel panel-success <?php echo $value['thisval']; ?>" >
                        <div class="panel-heading">
                         <label class="checkbox-inline" style="font-weight: bold;"> <input
                            class="main" type="checkbox" value="<?php echo $v['thisval']; ?>" name="prev[]"
                            <?php if($privilage[$v['thisval']] == 'Y'){ echo 'checked'; } ?>
                            onclick='check_enable(this.checked,[<?php echo implode(",",$v['disabled']);?>]);'> &nbsp;&nbsp; <?php echo $v['name']; ?> 
                        </label>
                    </div>
                    <div class="panel-body">
                        <?php
                        foreach ($v['additional'] as $k1 => $v1) {
                           ?>
                           
                           <div class="panel panel-warning" style="display: inline-block;margin-left: 10px;">
                            <div class="panel-heading">
                                <label class="checkbox-inline" style="font-weight: bold;"> <input type="checkbox"
                                    value="<?php  echo $v1['thisval'];?>" name="prev[]" onclick="check_enable(this.checked,[<?php echo implode(",",$v1['disabled']);?>]);"
                                    <?php if($privilage[$v1['thisval']] == 'Y'){ echo 'checked'; } ?>>
                                    &nbsp;<?php echo $v1['name']; ?>
                                </label>
                            </div>
                            <div class="panel-body">
                                <?php
                                foreach ($v1['sub'] as $k2 => $v2) {
                                  ?>
                                  
                                  <label class="checkbox-inline"> <input type="checkbox"
                                    value="<?php  echo $v2['thisval'];?>" name="prev[]"
                                    <?php if($privilage[$v2['thisval']] == 'Y'){ echo 'checked'; } ?> >
                                    &nbsp;<?php echo $v2['name']; ?>
                                </label>
                                <?php
                            }
                            ?>
                        </div>
                    </div>         
                    <?php
                }
                ?> 
            </div>  
        </div>  
        <?php
    }
    ?>
</fieldset>
<?php
}
}
}
else{
    ?>
    <div>You dont have permission to access this page</div>
    <?php
}
?>
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-info" onclick="savePrivilage();">Save</button>
    <button type="button" class="btn btn-default"
    onclick="loadData('Users/userManagementList.php');">Back</button>
</div>

