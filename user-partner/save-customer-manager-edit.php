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

   
    //obtém os dados do formulário preenchido
    $id_parceiro = $_POST['id'];
    $nome = $_POST['namePartner'];
    $razaoSocial = $_POST['razaoSocial'];
    $telefone = $_POST['phone'];
    $endereco = $_POST['address'];
    $responsavelfin = $_POST['responsible'];


    ///altera parceiro
    mysqli_query($conn, "update tb_parceiros set nome_parceiro='$nome', razaosocial_parceiro='$razaoSocial', telefone_parceiro='$telefone', endereco_parceiro='$endereco', responsavelfinanceiro_parceiro='$responsavelfin' where id_parceiro='$id_parceiro'") or die("Não foi possível alterar o cliente!");
    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: home.php");




    ?>
</head>

<body>
</body>

</html>