<?php
session_start();
error_reporting(0);
include_once('includes/db_con.php');

if(isset($_REQUEST['disid']))
{
	$disid = $_REQUEST['disid'];
	$dispass = $_REQUEST['dispass'];
	
	//echo $disid.'<br>'.$dispass;
	//echo 'True';
	//echo "duplicate";
	
	$result=pg_query($conn,"SELECT pwd from distributor_detail where did=$disid") or die(pg_error($conn));
	$r=pg_fetch_row($result);
	
	if($r[0]==$dispass)
	{
		$result=pg_query($conn,"SELECT status from distributor_detail where did=$disid") or die(pg_error($conn));	
		$r=pg_fetch_row($result);
		
		if($r[0]=='Deactive')
		{
			echo 'Your account is under verification process.';
		}
		else
		{
			$_SESSION['did']=$disid;
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