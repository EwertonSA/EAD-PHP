<?php 
include('lib/conexao.php');
include("lib/protect.php");
protect(0);
$sql_report = "SELECT r.id,u.nome,r.compra, r.valor FROM relatorio r, usuario u, curso c WHERE u.id=r.id_usuario AND c.id = r.id_curso";
$sql_query = $mysqli->query($sql_report) or die($mysqli->error);
$num_report = $sql_query->num_rows;
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-file-document bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Relatório </h4>
                    <span>Visualize as compras dos usuário dentro do sistema</span>
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
                    <li class="breadcrumb-item"><a href="#!">Relatório</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card-block table-border-style">
    <div class="table-responsive">
        <table class="table">
            <h5>Relatório</h5>
            <span>Examine o relatório de compras dos usuários</span>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuário</th>
                    <th>Curso</th>
                    <th>Data</th>
                    <th>valor</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($num_report == 0) { ?>
                    <tr>
                        <td colspan="5">Nenhum relatório foi cadastrado.</td>
                    </tr>
                <?php } else { 
                    while ($report = $sql_query->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?=$report['id']?></th>
                            <td><?=$report['nome']?></td>
                            <td><?=$report['titulo']?></td>
                            <td><?=  date('d/m/Y H:i',strtotime($report['compra']) )?></td>
                            <td>R$<?= number_format($report['creditos'],2,',','.')?></td>
                            
                        </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>
