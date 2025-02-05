<?php 

function sendFile($error, $size, $name, $tmp_name)
{
    include('conexao.php'); // Inclui a conexão ao banco de dados

    if ($error) {
        echo "Falha ao enviar arquivo.";
        return false;
    }

    if ($size > 2097152) { // Limite de 2 MB
        echo "Arquivo muito grande! Max: 2MB.";
        return false;
    }

    $pasta = 'upload/';
    $nomeDoArquivo = $name;
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if (!in_array($extensao, ['jpg', 'png', 'jpeg'])) {
        echo "Arquivo não aceito. Apenas JPG, PNG e JPEG são permitidos.";
        return false;
    }

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($tmp_name, $path);

    if ($deu_certo) {

        return $path;
    } else {
        echo "Erro ao mover o arquivo.";
        return false;
    }
}