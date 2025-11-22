<?php
session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['login'];

 if (isset($_POST['idEnte'])) {
  $idEnte = $_POST['idEnte'];
  echo "ID recebido: " . $idEnte;
} else {
  echo "Nenhum ID recebido via POST.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['imageName'])) {
    $logado = $_SESSION['login']; // Obtém o usuário logado
    $diretorio = "../assets/img/gallery/users/$idEnte/"; // Caminho da pasta do usuário
    $imagem = basename($_POST['imageName']); // Sanitiza o nome do arquivo
    $caminhoCompleto = $diretorio . $imagem; // Caminho do arquivo

    // Verifica se o arquivo existe antes de excluir
    if (file_exists($caminhoCompleto)) {
        unlink($caminhoCompleto);
        $_SESSION['mensagem'] = "Imagem excluída com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro: Imagem não encontrada.";
    }
} else {
    $_SESSION['mensagem'] = "Erro: Requisição inválida.";
}

header("Location: list-entes-media.php");
exit();
?>
