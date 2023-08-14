<?php
//New Consumer registration
include_once('includes/db_con.php');
if(isset($_REQUEST['conid']))
{
	$cid = $_REQUEST['conid'];
	$cmno = $_REQUEST['cmno'];
	$cpass = $_REQUEST['cpass'];
	
	//check user is registered?
	$result=pg_query($conn,"select status from consumer_detail where cid='$cid'") or die(pg_error($conn));
	$r=pg_fetch_row($result);
	
	if(pg_num_rows($result)==0)
	{
		echo 'We did not get any consumer id that linked with your mobile no.';
	}
	else if($r[0]=='Active' or $r[0]=='Deactive')
	{
		echo 'Your account/mobile no. is already registered.';
	}
	else if($r[0]=='Not Registered')
	{
		
		pg_query($conn,"UPDATE consumer_detail SET pwd='$cpass',reg_date='now()',status='Active' WHERE cid=$cid") or die(pg_error($conn));
		
		echo "<script>alert('Your registration has been done, Now you can do log-in.');
		
		</script>";
		
		echo 'True';
	}
}
else
{
	header('Location:index.php');
}
?>