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


    //obtém os dados do depoimento a ser deletado
    $id = $_GET['id'];
    
    //deleta o depoimento na base de dados
    $sqlApprove = "DELETE FROM tb_depoimentos_ente WHERE id_depoimento='$id'";
    mysqli_query($conn, $sqlApprove);

    session_start();

    $_SESSION['mensagem'] = 'Depoimento excluído com sucesso';
    header("Location: page-manager.php");
    ?>

</head>
    
    <body>

    </body>
    
</html>