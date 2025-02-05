<?php 
include('lib/conexao.php');
include("lib/protect.php");
protect(1);
$sql_course = "SELECT * FROM cursos";
$sql_query = $mysqli->query($sql_course) or die($mysqli->error);
$num_courses = $sql_query->num_rows;
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-file-document bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Gerenciar cursos</h4>
                    <span>Gerencie os cursos cadastrados no sistema.</span>
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
                    <li class="breadcrumb-item"><a href="#!">Gerenciar cursos</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card-block table-border-style">
    <div class="table-responsive">
        <table class="table">
            <h5>Todos os cursos</h5>
            <span><a href="index.php?p=createCourse">Clique aqui</a> para cadastrar um curso</span>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Preço</th>
                    <th>Gerenciar</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($num_courses == 0) { ?>
                    <tr>
                        <td colspan="5">Nenhum curso foi cadastrado.</td>
                    </tr>
                <?php } else { 
                    while ($course = $sql_query->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?=$course['id']?></th>
                            <td><img src="<?=$course['imagem']?>" alt="" width="50"></td>
                            <td><?=$course['titulo']?></td>
                            <td>R$<?= number_format($course['preco'],2,',','.')?></td>
                            <td>
                                <a href="index.php?p=editCourse&id=<?=$course['id']?>">Editar</a> | 
                                <a href="index.php?p=deleteCourse&id=<?=$course['id']?>">Excluir</a>
                            </td>
                        </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>
