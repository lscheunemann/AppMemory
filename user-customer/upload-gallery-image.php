<!doctype html>
<html>

<head>
    <?php
    require("../inc/connect.inc");
    session_start();
    if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['login'];

    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

    //busca o cliente e parceiro do ente
    $sql = "Select cliente, parceiro from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {

        $cliente = $linha["cliente"];
        $parceiro = $linha["parceiro"];
    }

    $repositorioBase = "../assets/img/gallery/users/";

    $subpastaUsuario = $logado;

    // Diretório onde o arquivo será salvo
    $repositorio = $repositorioBase . $subpastaUsuario . "/";

    // Verifica se o diretório existe, cria se necessário
    if (!is_dir($repositorio)) {
        mkdir($repositorio, 0755, true); // Cria o diretório com permissão
    }

    // Apagar todos os arquivos do repositório
    /*$arquivos = glob($repositorio . '*'); // Pega todos os arquivos do diretório
    foreach ($arquivos as $arquivo) {
        if (is_file($arquivo)) {
            unlink($arquivo); // Apaga o arquivo
        }
    }*/

    // Verificar se um arquivo foi enviado
    if (isset($_FILES['galleryPhoto']) && $_FILES['galleryPhoto']['error'] === 0) {
        // Escolher o nome do arquivo
        $novoNome = basename($_FILES['galleryPhoto']['name']);

        // Caminho completo para salvar o arquivo
        $caminhoCompleto = $repositorio . $novoNome;

        // Move o arquivo enviado para o repositório
        if (move_uploaded_file($_FILES['galleryPhoto']['tmp_name'], $caminhoCompleto)) {
            echo "Imagem salva com sucesso em: " . $caminhoCompleto;
        } else {
            echo "Erro ao salvar a imagem.";
        }
    } else {
        echo "Nenhuma imagem foi enviada ou ocorreu um erro.";
    }



    session_start();

    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: media.php");
    ?>
</head>

<body>
</body>

</html>