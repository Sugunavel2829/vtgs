<?php
	/*session_start();
	$sess_id = session_id();*/
	define('SESS_ID',$_SESSION[$sess_id.'_AUTH_ID']);
	include_once '../config/config.php';
	$sql = "SELECT privilages AS prev_Obj FROM authentication_privileges WHERE idAuthent = '".SESS_ID."'";
	$res1 = mysqli_query($conn,$sql);
	$result_Obj = fetch_single_object($res1);
	$previlage=unserialize($result_Obj->prev_Obj);
	
?>
 <style>
 	.padmenu{
 		padding-right: 10px; !important;
 	}
 </style>
<link rel="stylesheet" href="../assets/css/main.css">
<script type="text/javascript" src="../assets/js/PHC_MAIN.js"></script>
<script type="text/javascript" src="../assets/js/main.js"></script>
<script type="text/javascript" src="../assets/js/jquery-DOM.js"></script>
<div class="navbar-default sidebar" role="navigation" style="height:900px;overflow:auto;background-color:#0f3075" >
	<div class="sidebar-nav navbar-collapse in collapse">
		<ul class="nav" id="side-menu">
		    	<?php if($previlage['504'] == 'Y'){ ?>
			<li>
			  <a href="javascript:void(0);" onclick="loadData('Dashboard/dashboardList.php');">
			  	<span class="padmenu"><i class="fa fa-dashboard fa-fw"></i></span><span class="menuLabel">Dashboard</a></span>
			 </li>
			 <?php } ?>
			<!-- <li>
					<a onclick="loadData('Dashboard/dashboardList.php');"><i class="fa fa-dashboard fa-fw"></i><span class="menuLabel">Dashboard</span></a>
			</li>	 -->
			<?php if($previlage['500'] == 'Y'){ ?>
			<li>
				<a href="javascript:void(0);"><span class="spd padmenu"><i class="fa fa-hashtag"></i></span><span class="menuLabel">Masters</span><span class="fa arrow menuLabel"></span></a>
				<?php }?>
				<ul class="nav nav-second-level">
					<?php if($previlage['2'] == 'Y'){ ?>
					<li class="menuTitle">
						<a href="javascript:void(0);"><i class="fa fa-map-marker fa-fw"></i><span class="menuLabel">General Masters</span><span class="fa arrow"></span></a>
						<ul class="nav nav-third-level">
							<?php if($previlage['3'] == 'Y'){ ?>
							<li><a href="javascript:void(0);" onclick="loadData('Masters/institutionList.php');"><span class="menuLabel">&nbsp;&nbsp;&nbsp;Institution</span></a></li>
							<?php }?>
						<?php if($previlage['7'] == 'Y'){ ?>
							<li><a href="javascript:void(0);" onclick="loadData('Masters/categoryList.php');"><span class="menuLabel">&nbsp;&nbsp;&nbsp;Category</span></a></li>
							<?php }?>
							<?php if($previlage['11'] == 'Y'){ ?>
							<li><a href="javascript:void(0);" onclick="loadData('Masters/departmentList.php');"><span class="menuLabel">&nbsp;&nbsp;&nbsp;Department</span></a></li>
							<?php }?>
							
						</ul>
					</li>
					<?php } ?> 

					<?php if($previlage['15'] == 'Y'){ ?>
						<li class="menuTitle">
							<a href="javascript:void(0);"><i class="fa fa-user fa-fw"></i><span class="menuLabel">Users</span><span class="fa arrow menuLabel"></span></a>
							<ul class="nav nav-second-level">
								<?php if($previlage['16'] == 'Y'){ ?>
								<li><a href="javascript:void(0);"  onclick="loadData('Users/userTypeList.php');"><span class="menuLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User type</span></a></li>	
								<?php } ?>	
								<?php if($previlage['20'] == 'Y'){ ?>
								<li><a href="javascript:void(0);"  onclick="loadData('Users/userManagementList.php');"><span class="menuLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Application users</span></a></li>
								<?php } ?>
								<?php if($previlage['25'] == 'Y'){ ?>
								<li><a href="javascript:void(0);"  onclick="loadData('Users/userProfileList.php');"><span class="menuLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</span></a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				</ul>
				<?php if($previlage['501'] == 'Y'){?>
				<li>
				<a href="javascript:void(0);"><span class="spd padmenu"><i class="fa fa-book"></i></span><span class="menuLabel">Ticket Details</span><span class="fa arrow menuLabel"></span></a>
					<ul class="nav nav-second-level">
					<?php if($previlage['31'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/raiseTicketsList.php');"><span class="menuLabel">Raise a Ticket</span></a></li>
						<?php }?>
						<?php if($previlage['35'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/ticketHistoryList.php');"><span class="menuLabel">Ticket History</span></a></li>
						<?php }?>
					</ul>
				</li>
				<?php } ?>
			<?php if($previlage['502'] == 'Y'){ ?>
				<li>
				<a href="javascript:void(0);"><span class="spd padmenu"><i class="fa fa-book"></i></span><span class="menuLabel">Manage Complaint</span><span class="fa arrow menuLabel"></span></a>
					<ul class="nav nav-second-level">
					<?php if($previlage['47'] == 'Y'){  ?>
					<?php
                    		$query="SELECT rt_id AS pendingCount FROM raise_ticket WHERE rt_ticket_status='1' ";
                    	    $data=mysqli_query($conn,$query);
                    	    $pendingCount=row_count($data);
                    ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/pendingTicketList.php');"><span class="menuLabel">Pending Tickets</span><b class="label orange pull-right"><?php echo $pendingCount; ?></b></a></li>
						<?php }?>
						<?php if($previlage['49'] == 'Y'){ ?>
						<?php 
                    		$query1="SELECT rt_id AS pendingCount FROM raise_ticket WHERE rt_ticket_status='2' ";
                    	    $data1=mysqli_query($conn,$query1);
                    	    $processingCount=row_count($data1);
                    	?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/processingTicketList.php');"><span class="menuLabel">Tickets On Going</span><b class="label orange pull-right"><?php echo $processingCount; ?></b></a></li>
						<?php }?>
						<?php if($previlage['51'] == 'Y'){ ?>
						<?php 
                    		$query2="SELECT rt_id AS pendingCount FROM raise_ticket WHERE rt_ticket_status='3' ";
                    	    $data2=mysqli_query($conn,$query2);
                    	    $closedCount=row_count($data2);
                    	?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/closedTicketList.php');"><span class="menuLabel">Tickets Closed</span><b class="label orange pull-right"><?php echo $closedCount; ?></b></a></li>
						<?php }?>
						<?php if($previlage['53'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/sendMailList.php');"><span class="menuLabel">Sending Mails</span></a></li>
						<?php }?>
						<?php if($previlage['56'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Tickets/cancelTicketsList.php');"><span class="menuLabel">Cancelled Tickets</span></a></li>
					    <?php }?>
					</ul>
					<?php }?>
				</li>
			<?php if($previlage['503'] == 'Y'){ ?>
				<li>
				<a href="javascript:void(0);"><span class="spd padmenu"><i class="fa fa-book"></i></span><span class="menuLabel">Reports</span><span class="fa arrow menuLabel"></span></a>
					<ul class="nav nav-second-level">
					<?php if($previlage['63'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Reports/ticketsAllocatedReportList.php');"><span class="menuLabel">Ticket Allocated Report</span></a></li>
						<?php }?>
						<?php if($previlage['64'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Reports/TicketsClosedReportList.php');"><span class="menuLabel">Tickets Closed Report</span></a></li>
						<?php }?>
						<?php if($previlage['64'] == 'Y'){ ?>
						<li class="menuTitle"><a href="javascript:void(0);"  onclick="loadData('Reports/TicketsCancelReportList.php');"><span class="menuLabel">Tickets Cancelled Report</span></a></li>
						<?php }?>
					</ul>
					<?php }?>
				</li>
				
	</div>	
</div>
<input type="hidden" id="hideshow">
<style type="text/css">

	.menuLabel1{
		display: none;
	}

	.sidePan{
		width: 40px !important;
		overflow: hidden;
	}
	</style>

<script>
$(function() {
    $("a").on("click", function() {
        $("a.active").removeClass("active");
        $(this).addClass("active");
    });
});

$('.sidebar').click(function(){
  if($("#hideshow").val()=='1'){
  		$("#hideshow").val('2');
  	 	$('#page-wrapper').animate({ marginLeft: '250px' }, 100,callback());
  }
});
$('#hidShowPan').click(function(){
  if($("#hideshow").val()=='1'){
  		$("#hideshow").val('2');
  	 	$('#page-wrapper').animate({ marginLeft: '250px' }, 100,callback());
  }
  else{
  		$("#sidebar-nav").removeClass("navbar-collapse");
  		$('#page-wrapper').animate({ marginLeft: '40px' }, 100,callback());
	  	$(".menuLabel").addClass("menuLabel1");
	  	$(".sidebar").addClass("sidePan");
	  	$("#hideshow").val('1');
	  	$(".menuTitle").hide();
  }	
});	
function callback(){
		$(".menuLabel").removeClass("menuLabel1 sidePan");
  		$(".sidebar").removeClass("sidePan");
  		$(".menuTitle").show();
}
</script>
