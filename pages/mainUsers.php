<?php 
include('lib/conexao.php');
include("lib/protect.php");
protect(1);
$sql_course = "SELECT * FROM users";
$sql_query = $mysqli->query($sql_course) or die($mysqli->error);
$num_users = $sql_query->num_rows;
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-file-document bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Gerenciar usuários </h4>
                    <span>Gerencie os usuários cadastrados no sistema.</span>
                </div>  
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Gerenciar usuários</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card-block table-border-style">
    <div class="table-responsive">
        <table class="table">
            <h5>Todos os cursos</h5>
            <span><a href="index.php?p=createUser">Clique aqui</a> para cadastrar um usuário</span>
            <thead>
                <tr>
                    <th>#</th>
                    <th>nome</th>
                    <th>email</th>
                    <th>Creditos</th>
                    <th>cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($num_users == 0) { ?>
                    <tr>
                        <td colspan="5">Nenhum usuário foi cadastrado.</td>
                    </tr>
                <?php } else { 
                    while ($user = $sql_query->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?=$user['id']?></th>
                            <td><?=$user['nome']?></td>
                            <td><?=$user['email']?></td>
                            <td>R$<?= number_format($user['creditos'],2,',','.')?></td>
                            <td>
                                <a href="index.php?p=editUser&id=<?=$user['id']?>">Editar</a> | 
                                <a href="index.php?p=deleteUser&id=<?=$user['id']?>">Excluir</a>
                            </td>
                        </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>
