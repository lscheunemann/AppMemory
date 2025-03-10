<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['imageName'])) {
    $logado = $_SESSION['login']; // Obtém o usuário logado
    $diretorio = "../assets/img/gallery/users/$logado/"; // Caminho da pasta do usuário
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

header("Location: media.php");
exit();
?>
