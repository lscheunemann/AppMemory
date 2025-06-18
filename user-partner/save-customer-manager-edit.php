<!doctype html>
<html>

<head>
    <?php
    require("../inc/connect.inc");
    session_start();
    if ((!isset($_SESSION['loginPartner']) == true) and (!isset($_SESSION['senhaPartner']) == true)) {
        unset($_SESSION['loginPartner']);
        unset($_SESSION['senhaPartner']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['loginPartner'];

    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

    //busca o parceiro em questão
    $sql = "Select id_usuario_parceiro from tb_usuarios_parceiro where email_usuario_parceiro = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {
        $parceiro = $linha["id_usuario_parceiro"];
    }



    //obtém os dados do clçiente do formulário preenchido
    $codigo = $_POST['code'];
    $nome = $_POST['name'];
    $telefone = $_POST['phone'];
    $endereco = $_POST['address'];
    $plano = $_POST['plan'];


    ///altera cliente
    mysqli_query($conn, "update tb_clientes set nome_cliente='$nome', endereco_cliente='$endereco', telefone_cliente='$telefone', plano_cliente='$plano' where id_cliente='$codigo'") or die("Não foi possível alterar o cliente!");
    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: customer-manager.php");




    ?>
</head>

<body>
</body>

</html>