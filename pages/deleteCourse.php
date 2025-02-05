<?php 
include('lib/conexao.php');
include("lib/protect.php");
protect(1);
$id=intval($_GET['id']);
$query=$mysqli->query("SELECT imagem FROM cursos WHERE id='$id'");
$course=$query->fetch_assoc();
if(unlink($course['imagem'])){
    $mysqli->query("DELETE FROM cursos WHERE id='$id'")or die($mysqli->error);
}
die("<script>location.href=\"index.php?p=mainCourses\";</script>")
?>