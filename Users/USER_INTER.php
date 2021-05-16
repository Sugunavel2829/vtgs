<?php
include_once 'USER_CMS.php';
switch($_REQUEST['request']){
	case 'userInsertUpdate': userInsertUpdate(); 
	break;

	case 'privilageInsertUpdate': privilageInsertUpdate($_REQUEST['idAuthent'], $_REQUEST['prev']); 
	break;

	case 'userTypeInsertUpdate': userTypeInsertUpdate(); 
	break;
	
	case 'userProfileInsertUpdate':userProfileInsertUpdate(insert_val($_REQUEST['curnt_pass']),insert_val($_REQUEST['new_pass']),insert_val($_REQUEST['conform_pass']),insert_val($_REQUEST['idUser']));
}