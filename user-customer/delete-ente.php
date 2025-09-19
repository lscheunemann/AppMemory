<!doctype html>
<html>

<head>
    <?php
    require("../inc/connect.inc");
    // esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
    session_start();
    if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['login'];

    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

    //busca o cliente e parceiro do ente
   /* $sql = "Select cliente, parceiro from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {

        $cliente = $linha["cliente"];
        $parceiro = $linha["parceiro"];
    }
*/

    //obtém os dados do ente a ser deletado
    $id = $_GET['id'];


    //verifica se possui página ativa
    $sqlPageActive = "SELECT ativo FROM tb_configuracoes WHERE ente = '$id'";
    $resultadoPageActive = mysqli_query($conn, $sqlPageActive);
    while ($linhaPageActive = mysqli_fetch_array($resultadoPageActive)) {
        $status = $linhaPageActive["ativo"];
    }

    if (isset($status) && $status == 1) {
        header("Location: error-delete_ente.html");
    } else {
        mysqli_query($conn, "delete from tb_configuracoes where ente = '$id'") or die("Não foi possível deletar a configuração do Ente!");
        mysqli_query($conn, "delete from tb_depoimentos_ente where ente = '$id'") or die("Não foi possível deletar os depoimentos do Ente!");
        mysqli_query($conn, "delete from tb_entes where id_ente = '$id'") or die("Não foi possível deletar o Ente!");
        header("Location: ente-deletado.html");
    }


    // criar regra para verificar plano ativo futuramente


    ?>

</head>

<body>

</body>

</html>