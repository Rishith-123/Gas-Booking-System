<?php
session_start();
include_once('../../includes/db_con.php');
if(isset($_GET['del']) and isset($_SESSION['did']))
{
	pg_query($conn,'delete from consumer_detail where cid='.$_GET['del'].'') or die(pg_error($conn));
	header('Location:../man_con.php');
}
else
{
	header('Location:../index.php');
}
?>