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

    $id = $_GET['id'];


    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

 
    mysqli_query($conn, "update tb_usuarios_cliente set ativo=1 where id_usuario_cliente='$id'");




    session_start();

    header("Location: home.php");
    ?>
</head>

<body>
</body>

</html>