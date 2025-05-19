<!doctype html>
<html>

<head>
    <?php
    if (isset($_POST['id'])) {
    $idEnte = $_POST['id'];
    echo "ID recebido: " . $id;
    } else {
    echo "Nenhum ID recebido via POST.";
    }

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


    //obtém os dados do ente do formulário preenchido
    $curtidas = $_POST['activeLike'];
    $depoimentos = $_POST['activeTestimonials'];
    

    // se não receber nada via post significa que o valor é zero
    if (isset($curtidas)){
        $curtidas = 1;
    }
    else{
        $curtidas = 0;
    };
    if (isset($depoimentos)){
        $depoimentos = 1;
    }
    else{
        $depoimentos = 0;
    };

    


    mysqli_query($conn, "update tb_configuracoes set permite_curtir='$curtidas', permite_depoimentos='$depoimentos' where cliente='$cliente' AND ente='$idEnte'");




    session_start();

    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: list-entes-config.php");
    ?>
</head>

<body>
</body>

</html>