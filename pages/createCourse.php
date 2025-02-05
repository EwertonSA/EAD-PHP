<?php

include('lib/conexao.php');
include('lib/sendFile.php');
include("lib/protect.php");
protect(1);

if (isset($_POST['send'])) {
    $title = $mysqli->real_escape_string(trim($_POST['titulo']));
    $description = $mysqli->real_escape_string(trim($_POST['descricao']));
    $price = $mysqli->real_escape_string(trim($_POST['preco']));
    $content = $mysqli->real_escape_string(trim($_POST['conteudo']));
    $erro = [];

    if (!$title) {
        $erro[] = "Preencha o título";
    }
    if (!$description) {
        $erro[] = "Preencha a descrição";
    }
    if (!$price) {
        $erro[] = "Preencha o preço";
    }
    if (!$content) {
        $erro[] = "Preencha o conteúdo";
    }
    if (!isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0) {
        $erro[] = "Selecione uma imagem";
    }

    // Só continua se não houver erros
    if (count($erro) == 0) {
        $keepGoing = sendFile($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);

        if ($keepGoing !== false) {
            $sql_code = "INSERT INTO cursos (titulo, descricao, conteudo, preco, cadastro, imagem) 
                         VALUES ('$title', '$description', '$content', '$price', NOW(), '$keepGoing')";

            $sql_query = $mysqli->query($sql_code);

            if ($sql_query) {
                echo "Curso cadastrado com sucesso! <a href='index.php?p=mainCourses'>clique aqui</a>";
            } else {
                echo "Erro ao cadastrar: " . $mysqli->error;
            }
        } else {
            $erro[] = "Falha ao enviar a imagem.";
        }
    }

    // Exibe erros, se houver
    if (count($erro) > 0) {
        foreach ($erro as $e) {
            echo "<p style='color:red;'>$e</p>";
        }
    }
}
?>
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                <div class="d-inline">
                    <h4>Cadastrar curso</h4>
                    <span>Preencha as informações e clique em salvar.</span>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="index.php?p=mainCourses">Gerenciar cursos</a>
                    </li>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Cadastrar curso</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-header card">
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (isset($erro) && count($erro)) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($erro as $e) {
                            echo "$e<br>";
                        } ?>
                    </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Cadastrar curso</h5>
                        <span>Preencha as informações e clique para salvar</span>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option" style="width: 35px;">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <h4>Formulário de cadastro</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="titulo">Título</label>
                                        <input type="text" class="form-control" name="titulo" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="descricao">Descrição</label>
                                        <input type="text" class="form-control" name="descricao" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="imagem">Imagem</label>
                                        <input type="file" class="form-control" name="imagem" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="preco">Preço</label>
                                        <input type="text" class="form-control" name="preco" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="conteudo">Conteúdo</label>
                                        <textarea rows="8" class="form-control" name="conteudo" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <a href="index.php?p=mainCourses" class="btn btn-primary btn-round"><i class="ti-arrow-left"></i>Voltar</a>
                                    <button type="submit" name="send" class="btn btn-success float-right btn-round"><i class="ti-save"></i>Salvar Curso</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>