<?php 

	session_start();
	$sess_id = session_id();
	if(!$_SESSION[$sess_id.'_AUTH_ID']){
		header('location: ../');
	}
	include_once 'header.php';
?>
<div id="page-wrapper">
	<?php 
	include_once 'Dashboard/dashboardList.php';
	?>
</div>
<?php 
	// include_once 'Dashboard/dashboardList.php';
	include_once 'footer.php';
?>