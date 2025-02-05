<?php 

include('lib/conexao.php');
include('lib/sendFile.php');
include("lib/protect.php");
protect(1);

if(isset($_POST['send'])){
    $nome = $mysqli->real_escape_string(trim($_POST['nome']));
    $email = $mysqli->real_escape_string(trim($_POST['email']));
    $credit = $mysqli->real_escape_string(trim($_POST['creditos']));
    $pass = $mysqli->real_escape_string(trim($_POST['pass']));
    $confirm = $mysqli->real_escape_string(trim($_POST['confirm']));
    $admin=$mysqli->real_escape_string($_POST['admin']);
    $erro = [];

    if (!$nome) {
        $erro[] = "Preencha o nome";
    }
    if (!$email) {
        $erro[] = "Preencha o email";
    }
    if (!$credit) {
        $credit = 0;
    }
    if (!$pass) {
        $erro[] = "Preencha a senha";
    }
    if ($confirm != $pass) {
        $erro[] = "As senhas não são idênticas";
    }

    // Criptografa a senha
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    // Só continua se não houver erros
    if (count($erro) == 0) {
        // Insere o usuário no banco de dados
        $sql = "INSERT INTO users (nome, email, senha, cadastro, creditos,admin) VALUES ('$nome', '$email', '$pass', NOW(), '$credit','$admin')";
        
        if ($mysqli->query($sql)) {
            die("<script>location.href=\"index.php?p=mainUsers\";</script>");
        } else {
            $erro[] = "Erro ao salvar o usuário: " . $mysqli->error;
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
                                                        <h4>Cadastrar usuário</h4>
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
                                                        <li class="breadcrumb-item"><a href="index.php?p=mainCourses">Gerenciar usuários</a>
                                                        </li>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!">Cadastrar usuário</a>
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
                if(isset($erro)&& count($erro)){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach($erro as $e){echo "$e<br>";} ?>
                </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Cadastrar usuário</h5>
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
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" name="nome" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">''
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="creditos">Créditos</label>
                                        <input type="number" class="form-control" name="creditos" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pass">Senha</label>
                                        <input type="password" class="form-control" name="pass" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm">Confirmar senha</label>
                                        <input type="password" class="form-control" name="confirm" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="confirm">Tipo</label>
                                        <select name="admin" class="form-control" id="">
                                            <option value="0">Usuário</option>
                                            <option value="1">Admin</option>
                                        </select>
                                        </div>
                                </div>
                              
                                </div>
                             
                                <div class="col-lg-12">
                                <a href="index.php?p=mainUser"  class="btn btn-primary btn-round" ><i class="ti-arrow-left"></i>Voltar</a>
                                    <button type="submit" name="send" class="btn btn-success float-right btn-round" ><i class="ti-save"></i>Salvar Curso</button>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
