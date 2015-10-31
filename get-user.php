<?php
include_once 'MCAPI.php';
	$api = new MCAPI('a9aa65c50a15c1dc36eb43549c3eaff5-us2');
	$listid = '4bec16f145';
	$member = $api->listMemberInfo($listid, $_POST['email']);
	//$member = $api->listMemberInfo($listid, $_POST['email']);
	echo json_encode($member);
	//echo $_POST['email'];

	