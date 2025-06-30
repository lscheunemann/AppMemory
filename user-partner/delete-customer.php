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


    //verifica se possui entes com página ativa
    $sqlPageActive = "SELECT id_configuracao FROM tb_configuracoes WHERE cliente = '$id' AND ativo = 1 ";
    $resultadoPageActive = mysqli_query($conn, $sqlPageActive);
    while ($linhaPageActive = mysqli_fetch_array($resultadoPageActive)) {
        $id_config = $linhaPageActive["id_configuracao"];
    }

    if (isset($id_config) && $id_config > 0) {
        
        header("Location: error-delete_customer.html");
    } else {
        mysqli_query($conn, "update tb_clientes set deletado=1 where id_cliente='$id'") or die("Não foi possível deletar o cliente!");
        header("Location: customer-deletado.html");
    }


    // criar regra para verificar plano ativo futuramente


    ?>

</head>

<body>

</body>

</html>