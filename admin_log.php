<?php
session_start();
include_once('includes/db_con.php');

if(isset($_POST['ad_login']))
{
	// $aid = $_REQUEST['aid'];
	// $apass = $_REQUEST['apass'];
	
	$result=pg_query($conn,"SELECT pwd from admin where aid='$_POST[Ladid]'") or die(pg_error($conn));
	$r=pg_fetch_row($result);

	if($r[0]==$_POST['Ladpass'])
	{
		$_SESSION['aid']=$_POST['Ladid'];
		echo "<script>
            window.location.href='admin/index.php';
            </script>";
	}
	else
	{
		echo "<script>
            alert('Invalid ID or Password.'); 
			window.location.href='index.php';
            </script>";
	}
}
else
{
	header('Location:index.php');
}
?>

<?php

?>