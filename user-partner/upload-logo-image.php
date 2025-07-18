<!doctype html>
<html>

<head>
    <?php
    require("../inc/connect.inc");
    // esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
    session_start();
    if ((!isset($_SESSION['loginPartner']) == true) and (!isset($_SESSION['senhaPartner']) == true)) {
        unset($_SESSION['loginPartner']);
        unset($_SESSION['senhaPartner']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['loginPartner'];


    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

    //busca o cliente e parceiro do ente
/*    $sql = "Select cliente, parceiro from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {

        $cliente = $linha["cliente"];
        $parceiro = $linha["parceiro"];
    }
*/
    if (isset($_POST['idPartner'])) {
        $idPartner = $_POST['idPartner'];
        echo "ID recebido: " . $idPartner;
    } else {
        echo "Nenhum ID recebido via POST.";
    }

    // Diretório base onde as imagens serão salvas
    $repositorioBase = "../assets/img/gallery/logo-partner/";

    // Nome da subpasta específica do parceiro
    $subpastaUsuario = $idPartner;

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
    if (isset($_FILES['logoPhoto']) && $_FILES['logoPhoto']['error'] === 0) {
        // Obtém a extensão do arquivo
        $extensao = strtolower(pathinfo($_FILES['logoPhoto']['name'], PATHINFO_EXTENSION));

        // Gera um nome único baseado na quantidade de arquivos
        $novoNome = "imagem_logo" . ($qtdArquivos + 1) . "." . $extensao;

        // Caminho completo para salvar o arquivo
        $caminhoCompleto = $repositorio . $novoNome;

        // Move o arquivo enviado para o repositório do usuário
        if (move_uploaded_file($_FILES['logoPhoto']['tmp_name'], $caminhoCompleto)) {
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
    header("Location: config-manager.php");
    exit();

    ?>
</head>

<body>
</body>

</html>