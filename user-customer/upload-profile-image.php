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

    // Diretório base onde as imagens serão salvas
    $repositorioBase = "../assets/img/gallery/profile/";

    // Nome da subpasta específica do usuário logado
    $subpastaUsuario = $logado;

    // Diretório onde o arquivo será salvo
    $repositorio = $repositorioBase . $subpastaUsuario . "/";

    // Verifica se o diretório existe, cria se necessário
    if (!is_dir($repositorio)) {
        mkdir($repositorio, 0755, true); // Cria o diretório com permissão
    }

    // Conta quantos arquivos existem na pasta do usuário
    $arquivos = glob($repositorio . '*.{png,jpg,jpeg}', GLOB_BRACE);
    $qtdArquivos = ($arquivos) ? count($arquivos) : 0; // Se houver arquivos, conta. Caso contrário, assume 0.

    // Verificar se um arquivo foi enviado
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] === 0) {
        // Obtém a extensão do arquivo
        $extensao = strtolower(pathinfo($_FILES['profilePhoto']['name'], PATHINFO_EXTENSION));

        // Gera um nome único baseado na quantidade de arquivos
        $novoNome = "imagem_perfil" . ($qtdArquivos + 1) . "." . $extensao;

        // Caminho completo para salvar o arquivo
        $caminhoCompleto = $repositorio . $novoNome;

        // Move o arquivo enviado para o repositório do usuário
        if (move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $caminhoCompleto)) {
            echo "Imagem salva com sucesso em: " . $caminhoCompleto;
        } else {
            echo "Erro ao salvar a imagem.";
        }
    } else {
        echo "Nenhuma imagem foi enviada ou ocorreu um erro.";
    }

    // Redireciona para a página "media.php" com mensagem de sucesso
    session_start();
    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: media.php");
    exit();

    ?>
</head>

<body>
</body>

</html>