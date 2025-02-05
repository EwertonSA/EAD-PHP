<?php 
include('lib/conexao.php');
include("lib/protect.php");
protect(1);
$id=intval($_GET['id']);
$query=$mysqli->query("DELETE FROM users WHERE id='$id'");


die("<script>location.href=\"index.php?p=mainUsers\";</script>")
?>