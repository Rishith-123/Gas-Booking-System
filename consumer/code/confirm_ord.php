<?php
session_start();
include_once('../../includes/db_con.php');
include_once('../../apis/Way2SMS/way2sms-api.php');
include_once('../../apis/mail_cfg.php');
if(($_SERVER['REQUEST_METHOD'] === 'POST') and isset($_SESSION['cid']))
{
	$cid=$_SESSION['cid'];
	
	$result=pg_query($conn,'select status from order_detail where cid='.$cid.' order by date desc,time desc') or die(pg_error($conn));
	$r=pg_fetch_row($result);
	
	if(($r[0]=='Delivered') || (!isset($r[0])))
	{
		pg_query($conn,"INSERT INTO order_detail(cid, did, date, time ) VALUES ($cid,(select did from consumer_detail where cid=$cid),CURRENT_DATE,CURRENT_TIME)") or die(pg_error($conn));
		
		//fetch mobile no,email of consumer_detail
		$result=pg_query($conn,"select * from consumer_detail where cid=$cid") or die(pg_error($conn));
		$r=pg_fetch_assoc($result);
		$mno=$r['m_no'];
		$eid=$r['e_id'];
		//fetch current order placed details
		$result=pg_query($conn,"select * from order_detail where cid=$cid order by date desc,time desc") or die(pg_error($conn));
		$r=pg_fetch_assoc($result);
		
		//email
		$mail->addAddress("$eid");
		$mail->Subject = 'Order placed.';
		$mail->isHTML(true);
		$mailContent = "<h1>Order Id - ".$r['oid']."</h1>
						<h1>Playable Amount - ".$r['amt']."</h1>
				<p>We will definitely deliver it within week.</p>";
		$mail->Body = $mailContent;
		$mail->send();
			
		echo "<script>
				alert('Order successfully placed.');
				location.reload();
			</script>";
	}
	else
	{
		echo 'Your current <a href="track_refill.php" class="text-danger" style="text-decoration:underline">order</a> in progress.';		
	}
}
else
{
	header('Location:../index.php');
}
?>