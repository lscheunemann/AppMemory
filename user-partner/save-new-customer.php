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

    //busca o parceiro em questão
    $sql = "Select id_usuario_parceiro from tb_usuarios_parceiro where email_usuario_parceiro = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {
        $parceiro = $linha["id_usuario_parceiro"];
    }


    //obtém os dados do clçiente do formulário preenchido
    $nome = $_POST['name'];
    $endereco = $_POST['address'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['phone'];
    $email = $_POST['email'];
    $nomeVendedor = $_POST['seller'];
    $plano = $_POST['plan'];


    //verifica se já existe cliente existente
    $sqlConf = "Select id_cliente from tb_clientes where email_cliente = '$email'";
    $resultadoConf = mysqli_query($conn, $sqlConf);
    while ($linhaConf = mysqli_fetch_array($resultadoConf)) {
        $qtd = $linhaConf["id_cliente"];
    }
    if (isset($qtd) && $qtd > 0) {
        header("Location: error-customer-exist.html");
    } else {
        ///se não existe cria o novo cliente
        mysqli_query($conn, "insert into tb_clientes (parceiro, nome_cliente, status_cliente, endereco_cliente, cpf_cliente, telefone_cliente, email_cliente, plano_cliente, nome_vendedor) values ('$parceiro', '$nome', 1, '$endereco', '$cpf', '$telefone', '$email', '$plano', '$nomeVendedor')") or die("Não foi possível cadastrar o cliente!");
    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: customer-manager.php");
    }



    
    ?>
</head>

<body>
</body>

</html>