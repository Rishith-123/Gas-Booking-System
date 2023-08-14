<?php
session_start();
error_reporting(0);
include_once('includes/db_con.php');

if(isset($_REQUEST['conid']))
{
	$cid = $_REQUEST['conid'];
	$cpass = $_REQUEST['cpass'];
	
	$result=pg_query($conn,"SELECT pwd from consumer_detail where cid=$cid") or die(pg_error($conn));
	$r=pg_fetch_row($result);
		
	if($r[0]==$cpass)
	{
		$result=pg_query($conn,"SELECT status from consumer_detail where cid=$cid") or die(pg_error($conn));	
		$r=pg_fetch_row($result);
		
		if($r[0]=='Deactive')
		{
			echo 'Your account is now deactivated.';
		}
		else
		{
			$_SESSION['cid']=$cid;
			echo 'True';
		}
	}
	else
	{
		echo 'Invalid ID or Password.';
	}
}
else
{
	header('Location:index.php');
}
?>