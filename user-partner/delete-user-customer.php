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

    //busca o cliente e parceiro do ente
    $sql = "Select cliente, parceiro from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {

        $cliente = $linha["cliente"];
        $parceiro = $linha["parceiro"];
    }


    //obtém os dados do cliente a ser deletado
    $id = $_GET['id'];


    //vdeleta uruario

    mysqli_query($conn, "delete from tb_usuarios_cliente where id_usuario_cliente='$id'") or die("Não foi possível deletar o usuário do cliente!");
    header("Location: user-customer-deletado.html");





    ?>

</head>

<body>

</body>

</html>