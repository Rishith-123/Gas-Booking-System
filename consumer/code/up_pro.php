<?php
session_start();
include_once('../../includes/db_con.php');
if(isset($_POST['edit_type']) and isset($_SESSION['cid']))
{	
	$e_type=$_POST['edit_type'];
	$s_val=$_POST['val'];
	if($e_type=='mno_edit')
	{
		//echo 'mno';
		echo '
			<form method="post" onsubmit="return fs();">
				<small> (Without Country Code & Only 10 Digits.)</small>
				
				<input class="form-control" type="text" name="data" id="dmno" value='.$s_val.'
				pattern="[1-9]{1}[0-9]{9}" title="At least Ten Digits" maxlength="10" required>
				<p class="text-danger" id="msg"></p>
				<hr>
				<button class="btn btn-primary btn-block" type="submit" name="sub" value="m"><span class="glyphicon glyphicon-ok"></span> Update</button>
			</form>
		';
	}
	else if($e_type=='email_edit')
	{
		//echo 'email';
		echo '
			<form method="post" onsubmit="return fs();">
				<input class="form-control" type="email" name="data" id="demail" value='.$s_val.' maxlength="30" required>
				<p class="text-danger" id="msg"></p>
				<hr>
				<button class="btn btn-primary btn-block" type="submit" name="sub" value="e"><span class="glyphicon glyphicon-ok"></span> Update</button>
			</form>
		';
	}
	else if($e_type=='pwd_edit')
	{
		//echo 'pwd';
		echo '
			<form method="post" onsubmit="return fs();">
				<input class="form-control" type="text" name="data" id="dpass" value='.$s_val.' maxlength="16" pattern=".{6,}" title="Six or more characters" required>
				<p class="text-danger" id="msg"></p>
				<hr>
				<button class="btn btn-primary btn-block" type="submit" name="sub" value="p"><span class="glyphicon glyphicon-ok"></span> Update</button>
			</form>
		';
	}
	
	//ajax
	echo '
	<script>
	function fs()
	{
		data=$("[name='.'data'.']").val();
		sub=$("[name='.'sub'.']").val();

		$.ajax({
				type: "POST",
				url: "code/up_pro.php",
				data: "sub="+sub+"&data="+data,
				success: function(html)
				{
					$("#msg").html(html);
					if($("#msg").html()=="True")
					{
						alert("Update Successful.");
						location.reload();
					}
				}
		});	
		
		return false;
	}
	</script>
	';
}
else if(isset($_POST['sub']) and isset($_SESSION['cid']))
{	
	$cid=$_SESSION['cid'];
	
	$data=$_POST['data'];
	
	if($_POST['sub']=='m')
	{
		//mobile no update
		$result=pg_query($conn,"select m_no from consumer_detail where m_no=$data AND cid!=$cid") or pg_error($conn);
		
		if(pg_num_rows($result)>0)
		{
			echo 'Given mobile no. is already registered.';
		}
		else
		{
			echo 'True';
			pg_query($conn,"update consumer_detail set m_no=$data where cid=$cid");
		}
	}
	else if($_POST['sub']=='e')
	{
		//email update	
		$result=pg_query($conn,"select e_id from consumer_detail where e_id='$data' AND cid!=$cid") or pg_error($conn);
		
		if(pg_num_rows($result)>0)
		{
			echo 'Given email address is already registered.';
		}
		else
		{
			echo 'True';
			pg_query($conn,"update consumer_detail set e_id='$data' where cid=$cid");
		}
	}
	else if($_POST['sub']=='p')
	{
		//password update
		echo 'True';
		pg_query($conn,"update consumer_detail set pwd='$data' where cid=$cid");	
	}
}
else
{
	header('Location:../index.php');
}
?>