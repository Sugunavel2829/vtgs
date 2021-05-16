<?php
 	session_start();
	$sess_id = session_id();
	define('SESS_ID',$_SESSION[$sess_id.'_AUTH_ID']);

	include_once '../../config/config.php';	

	function userTypeInsertUpdate() {
		global $conn;
		$userType=$_POST['typeName'];
		$status=$_POST['uT_Status'];
		$arg=$_POST['typeId'];
		$preArr = array();
		$preArr[] = "typeName = '$userType'";
		
		if($arg==0){
			$sql = "INSERT INTO authentication_type SET aTypeName = '".insert_val($userType)."', aT_Status='".insert_val($status)."',aT_CDate='".db_now_time()."',aT_CBy='".SESS_ID."'";
		}else{
			$sql = "UPDATE authentication_type SET aTypeName = '".insert_val($userType)."',aT_Status='".insert_val($status)."', aT_EDate='".db_now_time()."',aT_EBy='".SESS_ID."' WHERE idAuthentType = '$arg'";
		} 
		$insert_result=mysqli_query($conn,$sql);
		echo 'true';
	}


function userInsertUpdate() {
	global $conn;
	$arg=$_POST['idAuthent'];
	$authType=$_POST['aTypeName'];
	$department=$_POST['department'];
	$idNum=$_POST['id_num'];
	$mailId=$_POST['email_id'];
	$contact=$_POST['contact_num'];
	$userNameDis=$_POST['aName'];
	$userName=$_POST['aLogName'];
	$password=$_POST['aLogPass'];
	$userStatus=$_POST['aLogStatus'];
	$preArr = array();
		//$preArr[] = "aName = '$Name'";
	$preArr[] = "aLogName = '$userName'";
		//$preArr[] = "aLogPass = '$password'";
	if($arg!=0){
		$preArr[] = "idAuthent != '$arg'";
	}
	if(!pre_check('authentication', 'idAuthent', $preArr)){
		echo 'false';
		return;
	}
	if($arg==0){
		$sql = "INSERT INTO authentication SET a_idAuthentType = '$authType',a_dept_id='$department',a_IdNumber='$idNum',a_Email='$mailId',a_mobile='$contact',aName = '$userNameDis', aLogName = '$userName',aLogPass = '".encrypt_pass($password)."', aLogStatus='$userStatus',aShow_Password='$password', aCreateBy = '".SESS_ID."', aCreateDate = '".db_now_time()."'";
		echo $sql;
	}else{
		$sql = "UPDATE authentication SET a_idAuthentType = '$authType',a_dept_id='$department',a_IdNumber='$idNum',a_Email='$mailId',a_mobile='$contact',aName = '$userNameDis', aLogName = '$userName',aLogPass = '".encrypt_pass($password)."', aLogStatus='$userStatus',aShow_Password='$password', aEditBy = '".SESS_ID."', aEditDate = '".db_now_time()."' WHERE idAuthent = '$arg'";
	}
	$insert_result=mysqli_query($conn,$sql);
	echo 'true';
}

function userProfileInsertUpdate($curntpass,$newpass,$confmpass,$arg){
	global $conn;
	$user="SELECT idAuthent FROM authentication where aLogPass='".encrypt_pass($curntpass)."' AND idAuthent='$arg'";
	$result=mysqli_query($conn,$user);
	$user_Obj = array_result($result);
	$authId=$user_Obj['idAuthent'];
	if($user_Obj){
		$sql="UPDATE authentication SET aLogPass='".encrypt_pass($newpass)."',aShow_Password='$newpass' WHERE idAuthent ='$arg'";
		$insert_result=mysqli_query($conn,$sql);
		echo 'true';
	}else{
		echo 'false';
	}
}

function privilageInsertUpdate($idAuthent, $prev) {
	global $conn;
	$str='';	
	foreach ($prev as $key => $value) {
		$privilage[$value]='Y';
	}
	$previlege=serialize($privilage);
	
	$preArr = array();
	$preArr[] = "idAuthent= '$idAuthent'";
	$jSqlArr = array();
	if(!is_array($prev)){
		$prev = array();
	} 
	if(!pre_check('authentication_privileges', 'idAuthentPrivilage', $preArr)){
		$sql = "UPDATE authentication_privileges SET privilages = '$previlege' WHERE idAuthent = '$idAuthent'";
	}else{
		$sql = "INSERT INTO authentication_privileges SET idAuthent = '$idAuthent', privilages = '$previlege'";
	}
	$insert_result=mysqli_query($conn,$sql);
	//query($sql);
	//$prev_Obj=fetch_single_object("select privilages as privilage from authentication_privileges where idAuthent=1");
	$prev_Obj = "SELECT privilages AS privilage FROM authentication_privileges WHERE idAuthent =1";
	
	$res1 = mysqli_query($conn,$prev_Obj);
	$result_Obj = fetch_single_object($res1);
	echo 'true';
}
