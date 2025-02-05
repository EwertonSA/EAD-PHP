<?php 

include('lib/conexao.php');
include('lib/sendFile.php');
include("lib/protect.php");
protect(1);
$id = intval($_GET['id']);
if (isset($_POST['send'])) {
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
        $erro[] = "Preencha o e-mail";
    }
    if (!$credit) {
        $credit = 0;
    }

    if ($confirm != $pass) {
        $erro[] = "As senhas não são idênticas";
    }

    // Só continua se não houver erros
    if (count($erro) == 0) {
        // Atualiza os dados do usuário
        $sql = "UPDATE users SET nome='$nome', email='$email', creditos='$credit', admin='$admin' WHERE id='$id'";
        if ($pass) {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET nome='$nome', email='$email', senha='$pass', creditos='$credit', admin='$admin' WHERE id='$id'";
        }

        // Executa a atualização no banco
        $mysqli->query($sql) or die($mysqli->error);
        die("<script>location.href=\"index.php?p=mainUsers\";</script>");
    }
}

// Recupera os dados do usuário para preencher o formulário
$sql_code = $mysqli->query("SELECT * FROM users WHERE id = '$id'") or die($mysqli->error);
$user = $sql_code->fetch_assoc();

?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-file-document bg-c-pink"></i>
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
                    <li class="breadcrumb-item"><a href="index.php?p=mainCourses">Gerenciar usuários</a></li>
                    <li class="breadcrumb-item"><a href="#!">Cadastrar usuário</a></li>
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
                        <?php foreach ($erro as $e) { echo "$e<br>"; } ?>
                    </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Cadastrar usuário</h5>
                        <span>Preencha as informações e clique para salvar</span>
                    </div>
                    <div class="card-block">
                        <h4>Formulário de cadastro</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" value="<?= $user['nome'] ?>" name="nome">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="creditos">Créditos</label>
                                        <input type="number" class="form-control" name="creditos" value="<?= $user['creditos'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pass">Senha</label>
                                        <input type="password" class="form-control" name="pass">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm">Confirmar senha</label>
                                        <input type="password" class="form-control" name="confirm">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="confirm">Tipo</label>
                                        <select name="admin" class="form-control" id="">
                                            <option value="0">Usuário</option>
                                            <option <?php if($user['admin']) echo 'selected' ?> value="1">Admin</option>
                                        </select>
                                        </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <a href="index.php?p=mainUser" class="btn btn-primary btn-round"><i class="ti-arrow-left"></i>Voltar</a>
                                <button type="submit" name="send" class="btn btn-success float-right btn-round"><i class="ti-save"></i>Salvar</button>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
